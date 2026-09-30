<?php

namespace Tests\Feature;

use App\Models\EquipmentSetting;
use Carbon\Carbon;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentUiTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_rental_page_no_longer_shows_status_or_quantity_controls(): void
    {
        $html = view('rental', [
            'equipmentSettings' => collect(),
            'errors' => new ViewErrorBag(),
        ])->render();

        $this->assertStringNotContainsString('Status:', $html);
        $this->assertStringNotContainsString('Quantity to Rent:', $html);
        $this->assertStringNotContainsString('quantity-input', $html);
    }

    public function test_admin_settings_page_no_longer_shows_equipment_status_management(): void
    {
        $html = view('admin.settings', [
            'equipmentSettings' => collect(),
            'systemSettings' => [
                'session_timeout_minutes' => 30,
                'max_login_attempts' => 5,
                'lockout_duration_minutes' => 15,
                'auto_mark_unavailable' => 1,
                'enable_login_rules' => 1,
            ],
            'recentLoginAttempts' => collect(),
            'currentUser' => (object) [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => null,
                'bio' => null,
            ],
            'errors' => new ViewErrorBag(),
        ])->render();

        $this->assertStringNotContainsString('Equipment Status Management', $html);
        $this->assertStringNotContainsString('name="equipment_status[', $html);
    }

    public function test_successful_rental_updates_staff_equipment_availability(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-27 13:00:00', 'Asia/Manila'));
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'staff',
        ]);

        EquipmentSetting::where('equipment_name', 'Tractor')->update(['total_quantity' => 2]);

        $this->post(route('rental.store'), [
            'customer_name' => 'Availability Test Customer',
            'age' => 21,
            'field_area' => 'Test Field',
            'primary_address' => 'Buguey',
            'usage_type' => 'public',
            'start_time' => '02:00 PM',
            'rental_from' => '2026-09-27',
            'rental_duration_hours' => 2,
            'total_amount' => 100,
            'equipment' => json_encode([['name' => 'Tractor', 'quantity' => 1]]),
        ])->assertRedirect(route('rental'));

        $this->get(route('rental.availability'))
            ->assertOk()
            ->assertJsonPath('Tractor.available', 1)
            ->assertJsonPath('Tractor.pending', 1)
            ->assertJsonPath('Tractor.maintenance', 0);

        $this->get(route('rental'))
            ->assertOk()
            ->assertSee('data-availability-equipment="Tractor" data-availability-state="available">1', false)
            ->assertSee('data-availability-equipment="Tractor" data-availability-state="pending">1', false);
    }
}
