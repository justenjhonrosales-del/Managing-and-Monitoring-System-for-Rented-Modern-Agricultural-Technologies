<?php

namespace Tests\Feature;

use App\Models\Rental;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportsApprovalVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_reports_only_show_rentals_after_payment_is_approved(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $waitingRental = Rental::create([
            'rental_number' => '#R201',
            'customer_name' => 'Waiting Customer',
            'age' => 32,
            'field_area' => 'North Field',
            'primary_address' => 'Zone 1, Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'pending',
            'rental_from' => '2026-09-29',
            'total_amount' => 500,
        ]);

        Rental::create([
            'rental_number' => '#R202',
            'customer_name' => 'Approved Customer',
            'age' => 45,
            'field_area' => 'South Field',
            'primary_address' => 'Zone 2, Buguey',
            'equipment' => [['name' => 'Kuliglig', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2026-09-29',
            'total_amount' => 300,
        ]);

        $this->get(route('admin.reports'))
            ->assertOk()
            ->assertSee('Approved Customer')
            ->assertDontSee('Waiting Customer');

        $this->patchJson(route('rents.markPaid', $waitingRental))
            ->assertOk()
            ->assertJsonPath('status', 'paid');

        $this->get(route('admin.reports'))
            ->assertOk()
            ->assertSee('Approved Customer')
            ->assertSee('Waiting Customer');
    }
}
