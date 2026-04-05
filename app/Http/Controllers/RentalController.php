<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\EquipmentSetting;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RentalController extends Controller
{
    public function index()
    {
        $equipmentSettings = EquipmentSetting::all()->keyBy('equipment_name');
        return view('rental', compact('equipmentSettings'));
    }

    public function manage()
    {
        $rentals = Rental::latest()->get();
        return view('admin.rentals', compact('rentals'));
    }

    public function reports(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = Rental::latest();
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $rentals = $query->get();
        return view('admin.reports', compact('rentals', 'status'));
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

        return view('admin.payments', compact('completedRentals', 'dailyIncome', 'monthlyIncome', 'totalIncome'));
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
            'age' => 'required|integer',
            'field_area' => 'required|string|max:255',
            'primary_address' => 'required|string',
            'notes' => 'nullable|string',
            'delivery_notes' => 'nullable|string',
            'equipment' => 'required|json',
            'rental_from' => 'nullable|date',
            'rental_to' => 'nullable|date',
            'rental_duration_hours' => 'nullable|numeric|min:0',
        ]);

        // Decode equipment JSON
        $equipment = json_decode($validated['equipment'], true);
        if (empty($equipment)) {
            return back()->withErrors(['equipment' => 'Please select at least one equipment.']);
        }

        // Check for duplicate customer names
        $duplicateCustomer = Rental::where('customer_name', $validated['customer_name'])
            ->exists();

        if ($duplicateCustomer) {
            return back()->withErrors(['customer_name' => 'This name is already applied for renting equipment.'])->withInput();
        }

        // Generate rental number
        $rentalNumber = Rental::generateRentalNumber();

        // Create rental
        $rental = Rental::create([
            'rental_number' => $rentalNumber,
            'customer_name' => $validated['customer_name'],
            'age' => $validated['age'],
            'field_area' => $validated['field_area'],
            'primary_address' => $validated['primary_address'],
            'notes' => $validated['notes'] ?? null,
            'delivery_notes' => $validated['delivery_notes'] ?? null,
            'equipment' => $equipment,
            'status' => 'pending',
            'rental_from' => $validated['rental_from'] ?? null,
            'rental_to' => $validated['rental_to'] ?? null,
            'rental_duration_hours' => $validated['rental_duration_hours'] ?? null,
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
            'message' => $exists ? 'This name is already applied for renting equipment.' : ''
        ]);
    }
}
