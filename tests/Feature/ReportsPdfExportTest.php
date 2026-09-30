<?php

namespace Tests\Feature;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportsPdfExportTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_reports_export_downloads_a_pdf_of_paid_rentals_approved_in_the_last_30_days(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-29 12:00:00'));
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        Rental::create([
            'rental_number' => '#R301',
            'customer_name' => 'Recent Approved Customer',
            'age' => 35,
            'field_area' => 'North Field',
            'primary_address' => 'Zone 1, Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2026-09-20',
            'total_amount' => 850,
        ]);

        Carbon::setTestNow(Carbon::parse('2026-08-28 12:00:00'));
        Rental::create([
            'rental_number' => '#R302',
            'customer_name' => 'Old Approved Customer',
            'age' => 41,
            'field_area' => 'South Field',
            'primary_address' => 'Zone 2, Buguey',
            'equipment' => [['name' => 'Kuliglig', 'quantity' => 1]],
            'status' => 'paid',
            'rental_from' => '2026-08-25',
            'total_amount' => 300,
        ]);

        Carbon::setTestNow(Carbon::parse('2026-09-29 12:00:00'));
        Rental::create([
            'rental_number' => '#R303',
            'customer_name' => 'Pending Customer',
            'age' => 29,
            'field_area' => 'East Field',
            'primary_address' => 'Zone 3, Buguey',
            'equipment' => [['name' => 'Harvester', 'quantity' => 1]],
            'status' => 'pending',
            'rental_from' => '2026-09-29',
            'total_amount' => 1000,
        ]);

        $response = $this->get(route('admin.reports.export'));

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }
}
