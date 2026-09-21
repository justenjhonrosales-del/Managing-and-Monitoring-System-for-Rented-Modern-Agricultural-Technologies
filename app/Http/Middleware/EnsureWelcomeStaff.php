<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureWelcomeStaff
{
    public function handle(Request $request, Closure $next)
    {
        if (session('welcome_dashboard_logged_in') && session('welcome_dashboard_role') === 'staff' && session('welcome_dashboard_user_id')) {
            return $next($request);
        }

        return redirect()->route('welcome.login.show');
    }
}
