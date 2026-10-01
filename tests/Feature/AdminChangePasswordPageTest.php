<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminChangePasswordPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_change_password_page_shows_password_form(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('OldPass123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/change-password');

        $response
            ->assertOk()
            ->assertSee('Change Password')
            ->assertSee('current_password')
            ->assertSee('new_password')
            ->assertSee('new_password_confirmation');
    }

    public function test_admin_password_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('OldPass123!'),
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/admin/change-password')
            ->put('/admin/settings/password', [
                'current_password' => 'OldPass123!',
                'new_password' => 'NewPass456!',
                'new_password_confirmation' => 'NewPass456!',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/admin/change-password');

        $this->assertTrue(Hash::check('NewPass456!', $user->refresh()->password));
    }

    public function test_session_based_admin_password_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('OldPass123!'),
        ]);

        $response = $this
            ->withSession([
                'welcome_dashboard_logged_in' => true,
                'welcome_dashboard_role' => 'admin',
                'welcome_dashboard_user_id' => $user->id,
            ])
            ->from('/admin/change-password')
            ->put('/admin/settings/password', [
                'current_password' => 'OldPass123!',
                'new_password' => 'NewPass456!',
                'new_password_confirmation' => 'NewPass456!',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/admin/change-password');

        $this->assertTrue(Hash::check('NewPass456!', $user->refresh()->password));
    }
}
