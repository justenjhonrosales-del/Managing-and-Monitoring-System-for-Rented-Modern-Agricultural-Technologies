<?php

namespace Tests\Feature;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchedulePageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_staff_schedule_page_displays_real_rentals_with_correct_equipment_labels(): void
    {
        $user = User::factory()->create();

        Rental::create([
            'rental_number' => '#R999',
            'user_id' => $user->id,
            'customer_name' => 'gibson salbaburo',
            'age' => 21,
            'field_area' => 'Aparri, Cagayan',
            'primary_address' => 'Aparri, Cagayan',
            'usage_type' => 'public',
            'start_time' => '02:00 PM',
            'notes' => null,
            'delivery_notes' => null,
            'equipment' => [[
                'name' => 'Tractor',
                'type' => 'tractor',
            ]],
            'status' => 'pending',
            'rental_from' => '2026-09-15',
            'rental_to' => null,
            'rental_duration_hours' => 2.4,
            'total_amount' => 3360,
        ]);

        $response = $this->withSession([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'staff',
        ])->get('/schedule');

        $response->assertOk();
        $response->assertSee('Delivery Schedule');
        $response->assertSee('gibson salbaburo');
        $response->assertSee('Tractor');
        $response->assertSee('Thresher');
        $response->assertSee('Kuliglig');
        $response->assertDontSee('Kuliglik');
    }
}
