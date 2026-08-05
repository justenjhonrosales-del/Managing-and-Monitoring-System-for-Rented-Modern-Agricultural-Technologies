<?php

namespace Tests\Feature;

use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class EquipmentUiTest extends TestCase
{
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
}
