<?php

namespace Tests\Feature;

use App\Models\EquipmentSetting;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEquipmentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_admin_can_set_available_quantity_without_changing_pending_rentals(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-27 13:00:00', 'Asia/Manila'));
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $equipment = EquipmentSetting::where('equipment_name', 'Tractor')->firstOrFail();
        $equipment->update(['total_quantity' => 2]);

        $rental = Rental::create([
            'rental_number' => '#T001',
            'customer_name' => 'Test Customer',
            'age' => 21,
            'field_area' => 'Test Field',
            'primary_address' => 'Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'pending',
            'rental_from' => '2026-09-27',
            'start_time' => '02:00 PM',
            'rental_duration_hours' => 2,
        ]);

        $this->get(route('admin.equipment'))
            ->assertOk()
            ->assertSee('href="/css/admin-sidebar.css"', false)
            ->assertSee('href="/css/admin-equipment.css?v=', false)
            ->assertSee('data-available="1"', false)
            ->assertSee('data-equipment-name="Tractor"', false);

        $this->put(route('admin.equipment.availability', $equipment), [
            'available_quantity' => 4,
            'equipment_setting_id' => $equipment->id,
        ])->assertRedirect(route('admin.equipment'));

        $this->assertDatabaseHas('equipment_settings', [
            'id' => $equipment->id,
            'total_quantity' => 5,
        ]);
        $this->assertDatabaseHas('rentals', [
            'id' => $rental->id,
            'status' => 'pending',
        ]);

        $this->get(route('admin.equipment'))->assertSee('data-available="4"', false);
    }

    public function test_admin_can_save_equipment_quantity_hours_and_hourly_rate(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $equipment = EquipmentSetting::where('equipment_name', 'Tractor')->firstOrFail();

        $this->put(route('admin.equipment.update'), [
            'equipment_items' => [[
                'id' => $equipment->id,
                'equipment_name' => $equipment->equipment_name,
                'total_quantity' => 4,
                'default_hours' => 2.5,
                'hourly_rate' => 850,
            ]],
        ])->assertRedirect(route('admin.equipment'));

        $this->assertDatabaseHas('equipment_settings', [
            'id' => $equipment->id,
            'total_quantity' => 4,
            'default_hours' => 2.5,
            'hourly_rate' => 850,
        ]);
    }

    public function test_admin_can_add_an_equipment_item(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $this->put(route('admin.equipment.update'), [
            'equipment_items' => [[
                'id' => '',
                'equipment_name' => 'Seeder',
                'total_quantity' => 2,
                'default_hours' => 1.5,
                'hourly_rate' => 600,
            ]],
        ])->assertRedirect(route('admin.equipment'));

        $this->assertDatabaseHas('equipment_settings', [
            'equipment_name' => 'Seeder',
            'total_quantity' => 2,
            'default_hours' => 1.5,
            'hourly_rate' => 600,
        ]);
    }

    public function test_admin_cannot_save_quantity_below_committed_equipment(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $equipment = EquipmentSetting::where('equipment_name', 'Tractor')->firstOrFail();
        $equipment->update(['total_quantity' => 2]);

        Rental::create([
            'rental_number' => '#T003',
            'customer_name' => 'Committed Customer',
            'age' => 21,
            'field_area' => 'Test Field',
            'primary_address' => 'Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 2]],
            'status' => 'pending',
        ]);

        $this->from(route('admin.equipment'))->put(route('admin.equipment.update'), [
            'equipment_items' => [[
                'id' => $equipment->id,
                'equipment_name' => $equipment->equipment_name,
                'total_quantity' => 1,
                'default_hours' => 1,
                'hourly_rate' => 500,
            ]],
        ])->assertRedirect(route('admin.equipment'))
            ->assertSessionHasErrors('equipment_items.0.total_quantity');

        $this->assertDatabaseHas('equipment_settings', [
            'id' => $equipment->id,
            'total_quantity' => 2,
        ]);
    }

    public function test_admin_cannot_save_a_negative_available_quantity(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $equipment = EquipmentSetting::where('equipment_name', 'Tractor')->firstOrFail();

        $this->putJson(route('admin.equipment.availability', $equipment), [
            'available_quantity' => -1,
        ])->assertUnprocessable();

        $this->assertDatabaseHas('equipment_settings', [
            'id' => $equipment->id,
            'total_quantity' => 2,
        ]);
    }

    public function test_availability_edit_preserves_a_scheduled_rental(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-27 15:00:00', 'Asia/Manila'));
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $equipment = EquipmentSetting::where('equipment_name', 'Tractor')->firstOrFail();
        $equipment->update(['total_quantity' => 2]);
        Rental::create([
            'rental_number' => '#T002',
            'customer_name' => 'Test Customer',
            'age' => 21,
            'field_area' => 'Test Field',
            'primary_address' => 'Buguey',
            'equipment' => [['name' => 'Tractor', 'quantity' => 1]],
            'status' => 'pending',
            'rental_from' => '2026-09-27',
            'start_time' => '02:00 PM',
            'rental_duration_hours' => 2,
        ]);

        $this->get(route('admin.equipment'))
            ->assertOk()
            ->assertSee('data-available="1"', false)
            ->assertDontSee('Pending')
            ->assertDontSee('Maintenance')
            ->assertDontSee('In Use');

        $this->put(route('admin.equipment.availability', $equipment), [
            'available_quantity' => 4,
            'equipment_setting_id' => $equipment->id,
        ])->assertRedirect(route('admin.equipment'));

        $this->assertDatabaseHas('equipment_settings', [
            'id' => $equipment->id,
            'total_quantity' => 5,
        ]);
        $this->get(route('admin.equipment'))->assertSee('data-available="4"', false);
    }
}