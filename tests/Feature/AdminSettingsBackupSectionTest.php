<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSettingsBackupSectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_settings_page_includes_backup_and_recovery_section(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/settings');

        $response
            ->assertOk()
            ->assertSee('Backup & Recovery')
            ->assertSee('Manual Backup')
            ->assertSee('Automatic Backup')
            ->assertSee('Generate and Download Manual Backup Now');
    }
}
