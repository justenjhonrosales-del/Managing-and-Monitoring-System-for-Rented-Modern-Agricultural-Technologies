<?php

namespace Tests\Feature;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMonitoringTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_payment_monitoring_uses_rental_dates_and_shows_renter_details(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-28 12:00:00'));
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        Rental::create([
            'rental_number' => '#R101',
            'customer_name' => 'Current Week Renter',
            'age' => 35,
            'field_area' => 'North Field',
            'primary_address' => 'Zone 1, Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2026-09-28',
            'total_amount' => 100,
        ]);

        Rental::create([
            'rental_number' => '#R102',
            'customer_name' => 'Earlier Month Renter',
            'age' => 42,
            'field_area' => 'South Field',
            'primary_address' => 'Zone 2, Buguey',
            'equipment' => [['name' => 'Kuliglig', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2026-09-01',
            'total_amount' => 200,
            'payment_amount' => 240,
        ]);

        Rental::create([
            'rental_number' => '#R103',
            'customer_name' => 'Previous Year Renter',
            'age' => 51,
            'field_area' => 'Old Field',
            'primary_address' => 'Zone 3, Buguey',
            'equipment' => [['name' => 'Harvester', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2025-12-31',
            'total_amount' => 500,
        ]);

        Rental::create([
            'rental_number' => '#R104',
            'customer_name' => 'Pending Renter',
            'age' => 28,
            'field_area' => 'Pending Field',
            'primary_address' => 'Zone 4, Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'pending',
            'rental_from' => '2026-09-28',
            'total_amount' => 900,
        ]);

        Rental::create([
            'rental_number' => '#R105',
            'customer_name' => 'Date Missing Renter',
            'age' => 30,
            'field_area' => 'West Field',
            'primary_address' => 'Zone 5, Buguey',
            'equipment' => [['name' => 'Brush Cutter', 'quantity' => 1]],
            'status' => 'paid',
            'total_amount' => 50,
        ]);

        $this->get(route('admin.payments'))
            ->assertOk()
            ->assertViewHas('weeklyIncome', 100.0)
            ->assertViewHas('monthlyIncome', 340.0)
            ->assertViewHas('yearlyIncome', 340.0)
            ->assertSee('₱100.00')
            ->assertSee('₱340.00')
            ->assertSee('₱240.00')
            ->assertSee('Current Week Renter')
            ->assertSee('Zone 1, Buguey')
            ->assertDontSee('<th>ID</th>', false)
            ->assertDontSee('<th>Equipment</th>', false)
            ->assertDontSee('<th>Rental Date</th>', false)
            ->assertSee('Previous Year Renter')
            ->assertSee('Date Missing Renter')
            ->assertDontSee('Pending Renter');
    }
}
