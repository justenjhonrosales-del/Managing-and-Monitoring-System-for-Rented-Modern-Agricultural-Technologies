<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_routes_allow_welcome_session_login(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $response = $this->get('/admin/rentals');

        $response->assertStatus(200);
    }

    public function test_admin_settings_page_renders_for_welcome_session_login(): void
    {
        session([
            'welcome_dashboard_logged_in' => true,
            'welcome_dashboard_role' => 'admin',
        ]);

        $response = $this->get('/admin/settings');

        $response->assertStatus(200);
    }
}
