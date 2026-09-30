<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\EquipmentSetting;
use App\Models\SystemSetting;
use App\Services\EquipmentAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RentalController extends Controller
{
    public function index(EquipmentAvailability $availability)
    {
        $equipmentSettings = EquipmentSetting::all()->keyBy('equipment_name');
        $equipmentStats = $this->equipmentAvailability($availability, $equipmentSettings);

        return view('rental', compact('equipmentSettings', 'equipmentStats'));
    }

    public function availability(EquipmentAvailability $availability)
    {
        $equipmentSettings = EquipmentSetting::all()->keyBy('equipment_name');

        return response()->json($this->equipmentAvailability($availability, $equipmentSettings));
    }

    private function equipmentAvailability(EquipmentAvailability $availability, iterable $equipmentSettings): array
    {
        $rentals = Rental::all();
        $now = now();
        $equipmentStats = [];

        foreach ($equipmentSettings as $equipment) {
            $equipmentStats[$equipment->equipment_name] = $availability->summarize(
                (int) $equipment->total_quantity,
                $equipment->equipment_name,
                $rentals,
                $now
            );
        }

        return $equipmentStats;
    }

    public function manage()
    {
        $rentals = Rental::latest()->get();
        return view('admin.rentals', compact('rentals'));
    }

    public function paidRentals()
    {
        $rentals = Rental::where('status', 'paid')
            ->orderBy('rental_from', 'asc')
            ->orderByRaw("STR_TO_DATE(start_time, '%h:%i %p') ASC")
            ->get();
        return view('admin.paid-rentals', compact('rentals'));
    }

    public function userIndex()
    {
        if (Auth::check()) {
            $rentals = Auth::user()->rentals()
                ->orderBy('rental_from', 'asc')
                ->orderByRaw("STR_TO_DATE(start_time, '%h:%i %p') ASC")
                ->get();
        } elseif (session('welcome_dashboard_logged_in')) {
            $rentals = Rental::orderBy('rental_from', 'asc')
                ->orderByRaw("STR_TO_DATE(start_time, '%h:%i %p') ASC")
                ->get();
        } else {
            abort(403);
        }

        return view('rents.index', compact('rentals'));
    }

    public function userShow($id)
    {
        if (Auth::check()) {
            $rental = Auth::user()->rentals()->findOrFail($id);
        } elseif (session('welcome_dashboard_logged_in')) {
            $rental = Rental::findOrFail($id);
        } else {
            abort(403);
        }

        return view('rents.show', compact('rental'));
    }

    public function reports(Request $request)
    {
        $rentals = Rental::where('status', 'paid')
            ->latest()
            ->get();

        return view('admin.reports', compact('rentals'));
    }

    public function exportReportsPdf()
    {
        $periodEnd = now();
        $periodStart = $periodEnd->copy()->subDays(30);
        $paidRentals = Rental::where('status', 'paid')
            ->whereBetween('updated_at', [$periodStart, $periodEnd])
            ->orderByDesc('updated_at')
            ->get();
        $totalAmount = $paidRentals->sum(static function (Rental $rental): float {
            return (float) ($rental->payment_amount !== null && $rental->payment_amount > 0
                ? $rental->payment_amount
                : $rental->total_amount);
        });

        $pdf = app('dompdf.wrapper')
            ->loadView('admin.reports-pdf', compact('paidRentals', 'periodStart', 'periodEnd', 'totalAmount'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Approved_Rentals_Last_30_Days_' . now()->format('Y-m-d') . '.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $rental->update([
            'status' => $request->status,
            'total_amount' => $request->total_amount,
            'rental_from' => $request->rental_from ?? $rental->rental_from,
            'rental_to' => $request->rental_to ?? $rental->rental_to,
            'rental_duration_hours' => $request->rental_duration_hours ?? $rental->rental_duration_hours,
        ]);

        return redirect()->route('admin.rentals')->with('success', 'Rental updated successfully!');
    }

    public function payments()
    {
        // Payment monitoring follows the scheduled rental date and recorded price.
        $paidRentals = Rental::where('status', 'paid')
            ->orderByDesc('rental_from')
            ->orderByDesc('id')
            ->get();

        $now = now();
        $rentalPrice = static fn (Rental $rental): float => (float) (
            $rental->payment_amount !== null && $rental->payment_amount > 0
                ? $rental->payment_amount
                : $rental->total_amount
        );
        $incomeBetween = static function ($start, $end) use ($paidRentals, $rentalPrice): float {
            return $paidRentals->sum(static function (Rental $rental) use ($start, $end, $rentalPrice): float {
                return $rental->rental_from && $rental->rental_from->between($start, $end)
                    ? $rentalPrice($rental)
                    : 0;
            });
        };

        $weeklyIncome = $incomeBetween($now->copy()->startOfWeek(), $now->copy()->endOfWeek());
        $monthlyIncome = $incomeBetween($now->copy()->startOfMonth(), $now->copy()->endOfMonth());
        $yearlyIncome = $incomeBetween($now->copy()->startOfYear(), $now->copy()->endOfYear());

        return view('admin.payments', compact('paidRentals', 'weeklyIncome', 'monthlyIncome', 'yearlyIncome'));
    }

    public function exportPaymentsPdf()
    {
        // Get completed rentals with payment values
        $completedRentals = Rental::where('status', 'completed')
            ->whereNotNull('total_amount')
            ->where('total_amount', '>', 0)
            ->latest()
            ->get();

        // Calculate income metrics
        $today = now()->startOfDay();
        $thisMonth = now()->startOfMonth();

        $dailyIncome = Rental::where('status', 'completed')
            ->whereNotNull('total_amount')
            ->where('total_amount', '>', 0)
            ->whereBetween('updated_at', [$today, $today->copy()->endOfDay()])
            ->sum('total_amount');

        $monthlyIncome = Rental::where('status', 'completed')
            ->whereNotNull('total_amount')
            ->where('total_amount', '>', 0)
            ->whereBetween('updated_at', [$thisMonth, $thisMonth->copy()->endOfMonth()])
            ->sum('total_amount');

        $totalIncome = Rental::where('status', 'completed')
            ->whereNotNull('total_amount')
            ->where('total_amount', '>', 0)
            ->sum('total_amount');

        $data = [
            'completedRentals' => $completedRentals,
            'dailyIncome' => $dailyIncome,
            'monthlyIncome' => $monthlyIncome,
            'totalIncome' => $totalIncome,
            'reportDate' => now()->format('F d, Y'),
        ];

        // Try to use DomPDF facade if available
        try {
            $pdf = app('dompdf.wrapper')->loadView('admin.payments-pdf', $data);
            return $pdf->download('Payments_Report_' . now()->format('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            // Fallback to rendering HTML for download
            $html = view('admin.payments-pdf', $data)->render();
            return response($html, 200)
                ->header('Content-Type', 'text/html; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="Payments_Report_' . now()->format('Y-m-d') . '.html"');
        }
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rentalNumber = $rental->rental_number;
        $rental->delete();

        return back()->with('success', "Rental {$rentalNumber} deleted successfully!");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'field_area' => 'required|string|max:255',
            'primary_address' => 'required|string',
            'usage_type' => 'required|in:public,private',
            'start_time' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'delivery_notes' => 'nullable|string',
            'equipment' => 'required|json',
            'rental_from' => 'required|date',
            'rental_to' => 'nullable|date',
            'rental_duration_hours' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Decode equipment JSON
        $equipment = json_decode($validated['equipment'], true);
        if (empty($equipment)) {
            return back()->withErrors(['equipment' => 'Please select at least one equipment.'])->withInput();
        }

        // Check for duplicate customer names for the same authenticated user
        $duplicateCustomer = Rental::where('customer_name', $validated['customer_name'])
            ->where('user_id', Auth::id())
            ->exists();

        if ($duplicateCustomer) {
            return back()->withErrors(['customer_name' => 'This name is already applied for renting equipment.'])->withInput();
        }

        // Generate rental number
        $rentalNumber = Rental::generateRentalNumber();

        // Create rental
        $rental = Rental::create([
            'rental_number' => $rentalNumber,
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'age' => $validated['age'],
            'field_area' => $validated['field_area'],
            'primary_address' => $validated['primary_address'],
            'usage_type' => $validated['usage_type'],
            'start_time' => $validated['start_time'],
            'notes' => $validated['notes'] ?? null,
            'delivery_notes' => $validated['delivery_notes'] ?? null,
            'equipment' => $equipment,
            'status' => 'pending',
            'rental_from' => $validated['rental_from'] ?? null,
            'rental_to' => $validated['rental_to'] ?? null,
            'rental_duration_hours' => $validated['rental_duration_hours'] ?? null,
            'total_amount' => $validated['total_amount'],
        ]);

        // Auto-mark equipment as unavailable if setting is enabled
        $autoMarkUnavailable = SystemSetting::get('auto_mark_unavailable', 1);
        if ($autoMarkUnavailable) {
            foreach ($equipment as $item) {
                $equipmentName = $item['name'];
                $equipmentSetting = EquipmentSetting::where('equipment_name', $equipmentName)->first();
                if ($equipmentSetting) {
                    $equipmentSetting->update([
                        'status' => 'unavailable',
                        'is_available' => false,
                    ]);
                }
            }
        }

        return redirect()->route('rental')->with('success', "Rental request submitted! Your Rental ID: {$rentalNumber}");
    }

    public function checkDuplicateName(Request $request)
    {
        $customerName = $request->input('customer_name', '');
        
        if (empty($customerName)) {
            return response()->json([
                'exists' => false,
                'message' => ''
            ]);
        }

        $exists = Rental::where('customer_name', $customerName)->exists();

        return response()->json([
            'exists' => $exists,
        ]);
    }

    public function markPaid(Request $request, Rental $rental)
    {
        if (!Auth::check() && !session('welcome_dashboard_logged_in')) {
            return response()->json(['message' => 'Unauthorized to update this rental.'], 403);
        }

        if (Auth::check() && $rental->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized to update this rental.'], 403);
        }

        if ($rental->status !== 'pending') {
            return response()->json(['message' => 'Only pending rentals can be marked as paid.'], 422);
        }

        // Check if equipment is Reaper/Thresher by inspecting the rental's equipment JSON
        $isReaperThresher = false;
        if (is_array($rental->equipment) && count($rental->equipment) > 0) {
            $equipmentName = $rental->equipment[0]['name'] ?? null;
            if ($equipmentName === 'Reaper or Thresher') {
                $isReaperThresher = true;
            }
        }

        // For Reaper/Thresher, validate and require payment_amount
        if ($isReaperThresher) {
            $paymentAmount = $request->input('payment_amount');

            // Validate payment_amount is provided
            if (empty($paymentAmount)) {
                return response()->json([
                    'message' => 'Payment amount is required for Reaper/Thresher rentals.',
                    'error' => 'payment_amount_required'
                ], 422);
            }

            // Validate payment_amount is numeric
            if (!is_numeric($paymentAmount)) {
                return response()->json([
                    'message' => 'Payment amount must be a valid number.',
                    'error' => 'payment_amount_invalid'
                ], 422);
            }

            // Validate payment_amount is greater than 0
            if ((float) $paymentAmount <= 0) {
                return response()->json([
                    'message' => 'Payment amount must be greater than 0.',
                    'error' => 'payment_amount_invalid'
                ], 422);
            }

            // Update with payment_amount
            $rental->update([
                'status' => 'paid',
                'payment_amount' => (float) $paymentAmount
            ]);
        } else {
            // For other equipment (Tractor, Kuliglik), keep existing flow without payment_amount
            $rental->update(['status' => 'paid']);
        }

        return response()->json([
            'message' => 'Rental marked as paid successfully.',
            'status' => 'paid',
        ]);
    }
}
