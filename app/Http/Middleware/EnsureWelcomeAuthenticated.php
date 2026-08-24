<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureWelcomeAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() || session('welcome_dashboard_logged_in')) {
            return $next($request);
        }

        return redirect()->route('welcome.login.show');
    }
}
