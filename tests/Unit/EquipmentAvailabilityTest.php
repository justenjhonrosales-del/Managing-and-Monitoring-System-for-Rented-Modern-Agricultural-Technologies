<?php

namespace Tests\Unit;

use App\Models\Rental;
use App\Services\EquipmentAvailability;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class EquipmentAvailabilityTest extends TestCase
{
    public function test_hourly_rental_transitions_from_pending_to_maintenance_then_available(): void
    {
        $rental = new Rental([
            'status' => 'pending',
            'rental_from' => '2026-09-27',
            'start_time' => '02:00 PM',
            'rental_duration_hours' => 2,
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
        ]);
        $availability = new EquipmentAvailability();

        $beforeStart = $availability->summarize(2, 'Tractor', [$rental], CarbonImmutable::parse('2026-09-27 13:00', 'Asia/Manila'));
        $duringRental = $availability->summarize(2, 'Tractor', [$rental], CarbonImmutable::parse('2026-09-27 15:00', 'Asia/Manila'));
        $duringMaintenance = $availability->summarize(2, 'Tractor', [$rental], CarbonImmutable::parse('2026-09-27 17:00', 'Asia/Manila'));
        $afterMaintenance = $availability->summarize(2, 'Tractor', [$rental], CarbonImmutable::parse('2026-09-27 18:00', 'Asia/Manila'));

        $this->assertSame(['available' => 1, 'pending' => 1, 'maintenance' => 0], $beforeStart);
        $this->assertSame(['available' => 1, 'pending' => 1, 'maintenance' => 0], $duringRental);
        $this->assertSame(['available' => 1, 'pending' => 0, 'maintenance' => 1], $duringMaintenance);
        $this->assertSame(['available' => 2, 'pending' => 0, 'maintenance' => 0], $afterMaintenance);
    }

    public function test_kuliglig_days_are_counted_as_full_day_rentals(): void
    {
        $rental = new Rental([
            'status' => 'paid',
            'rental_from' => '2026-09-27',
            'start_time' => '02:00 PM',
            'rental_duration_hours' => 1,
            'equipment' => [['name' => 'Kuliglig', 'quantity' => 1, 'meta' => ['days' => 1]]],
        ]);
        $availability = new EquipmentAvailability();

        $duringDayRental = $availability->summarize(2, 'Kuliglig', [$rental], CarbonImmutable::parse('2026-09-28 13:00', 'Asia/Manila'));
        $duringMaintenance = $availability->summarize(2, 'Kuliglig', [$rental], CarbonImmutable::parse('2026-09-28 15:00', 'Asia/Manila'));

        $this->assertSame(['available' => 1, 'pending' => 1, 'maintenance' => 0], $duringDayRental);
        $this->assertSame(['available' => 1, 'pending' => 0, 'maintenance' => 1], $duringMaintenance);
    }

    public function test_utc_server_time_is_compared_to_local_rental_schedule_time(): void
    {
        $rental = new Rental([
            'status' => 'pending',
            'rental_from' => '2026-09-27',
            'start_time' => '02:00 PM',
            'rental_duration_hours' => 3,
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
        ]);
        $availability = new EquipmentAvailability();

        $counts = $availability->summarize(
            5,
            'Tractor',
            [$rental],
            CarbonImmutable::parse('2026-09-26 22:50', 'UTC')
        );
        $atRentalEnd = $availability->summarize(
            5,
            'Tractor',
            [$rental],
            CarbonImmutable::parse('2026-09-27 09:00', 'UTC')
        );
        $afterMaintenance = $availability->summarize(
            5,
            'Tractor',
            [$rental],
            CarbonImmutable::parse('2026-09-27 11:00', 'UTC')
        );

        $this->assertSame(['available' => 4, 'pending' => 1, 'maintenance' => 0], $counts);
        $this->assertSame(['available' => 4, 'pending' => 0, 'maintenance' => 1], $atRentalEnd);
        $this->assertSame(['available' => 5, 'pending' => 0, 'maintenance' => 0], $afterMaintenance);
    }
}