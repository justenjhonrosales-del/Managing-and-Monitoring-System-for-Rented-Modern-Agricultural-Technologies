<?php

namespace App\Http\Controllers;

use App\Models\EquipmentSetting;
use App\Models\Rental;
use App\Services\EquipmentAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminEquipmentController extends Controller
{
    public function __construct(private EquipmentAvailability $availability)
    {
    }

    public function index()
    {
        $rentals = Rental::all();
        $now = now();
        $equipmentItems = EquipmentSetting::query()->orderBy('id')->get()->map(function (EquipmentSetting $equipment) use ($rentals, $now) {
            $equipment->availability = $this->availability->summarize(
                (int) $equipment->total_quantity,
                $equipment->equipment_name,
                $rentals,
                $now
            );
            $equipment->image = $this->imageFor($equipment->equipment_name);

            return $equipment;
        });

        return view('admin.equipment', compact('equipmentItems'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'equipment_items' => ['required', 'array', 'min:1'],
            'equipment_items.*.id' => ['nullable', 'integer', 'exists:equipment_settings,id'],
            'equipment_items.*.equipment_name' => ['required', 'string', 'max:255'],
            'equipment_items.*.total_quantity' => ['required', 'integer', 'min:0', 'max:9999'],
            'equipment_items.*.default_hours' => ['required', 'numeric', 'min:0.25', 'max:24'],
            'equipment_items.*.hourly_rate' => ['required', 'numeric', 'min:0', 'max:9999999'],
        ]);

        $rentals = Rental::all();

        DB::transaction(function () use ($validated, $rentals) {
            foreach ($validated['equipment_items'] as $index => $item) {
                if (!empty($item['id'])) {
                    $equipment = EquipmentSetting::query()->lockForUpdate()->findOrFail($item['id']);
                } else {
                    $equipmentName = trim($item['equipment_name']);
                    if (EquipmentSetting::query()->where('equipment_name', $equipmentName)->exists()) {
                        throw ValidationException::withMessages([
                            "equipment_items.{$index}.equipment_name" => "{$equipmentName} is already in the equipment list.",
                        ]);
                    }

                    $equipment = new EquipmentSetting([
                        'equipment_name' => $equipmentName,
                        'status' => 'available',
                        'is_available' => true,
                    ]);
                }

                $counts = $this->availability->rentalCounts($equipment->equipment_name, $rentals, now());
                $committedQuantity = $counts['pending'] + $counts['maintenance'];

                if ($item['total_quantity'] < $committedQuantity) {
                    throw ValidationException::withMessages([
                        "equipment_items.{$index}.total_quantity" => "Quantity for {$equipment->equipment_name} cannot be less than its {$committedQuantity} committed unit(s).",
                    ]);
                }

                $equipment->fill([
                    'total_quantity' => $item['total_quantity'],
                    'default_hours' => $item['default_hours'],
                    'hourly_rate' => $item['hourly_rate'],
                ])->save();
            }
        });

        return redirect()->route('admin.equipment')->with('success', 'Equipment settings saved.');
    }

    public function updateAvailability(Request $request, EquipmentSetting $equipmentSetting)
    {
        $validated = $request->validate([
            'available_quantity' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        DB::transaction(function () use ($equipmentSetting, $validated) {
            $equipment = EquipmentSetting::query()
                ->lockForUpdate()
                ->findOrFail($equipmentSetting->id);
            $counts = $this->availability->rentalCounts($equipment->equipment_name, Rental::all(), now());

            $equipment->total_quantity = $validated['available_quantity'] + $counts['pending'] + $counts['maintenance'];
            $equipment->save();
        });

        return redirect()->route('admin.equipment')->with('success', 'Equipment availability updated.');
    }

    private function imageFor(string $equipmentName): string
    {
        $knownImages = [
            'tractor' => 'tractor.png',
            'reaper or thresher' => 'reaper or thresher.jpg',
            'kuliglig' => 'kuliglig.jpg',
            'parang' => 'Parang.jpg',
            'harvester' => 'harvester.png',
            'rototiller' => 'Rototiller.png',
            'brush cutter' => 'Brush Cutter.png',
        ];
        $key = strtolower(trim($equipmentName));

        if (isset($knownImages[$key])) {
            return $knownImages[$key];
        }

        $slug = Str::slug($equipmentName);
        foreach (['png', 'jpg', 'jpeg', 'webp'] as $extension) {
            $filename = $slug . '.' . $extension;
            if (is_file(public_path('images/' . $filename))) {
                return $filename;
            }
        }

        foreach (glob(public_path('images/*')) ?: [] as $imagePath) {
            if (Str::slug(pathinfo($imagePath, PATHINFO_FILENAME)) === $slug) {
                return basename($imagePath);
            }
        }

        return 'tractor.png';
    }
}