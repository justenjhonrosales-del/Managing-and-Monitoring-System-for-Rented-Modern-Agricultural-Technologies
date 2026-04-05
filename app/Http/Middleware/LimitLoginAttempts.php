<?php

namespace App\Http\Middleware;

use App\Models\LoginAttempt;
use App\Models\SystemSetting;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LimitLoginAttempts
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->path() !== 'login' || $request->method() !== 'POST') {
            return $next($request);
        }

        // Check if login rules are enabled
        $enableLoginRules = SystemSetting::get('enable_login_rules', 1);
        if (!$enableLoginRules) {
            return $next($request);
        }

        $email = $request->input('email');
        $ipAddress = $request->ip();
        $maxAttempts = (int) SystemSetting::get('max_login_attempts', 5);
        $lockoutDuration = (int) SystemSetting::get('lockout_duration_minutes', 15);

        // Check if user account is locked
        $user = User::where('email', $email)->first();
        if ($user && $user->locked_until && $user->locked_until > now()) {
            return response()->view('auth.login', [
                'error' => 'Account locked due to too many failed login attempts. Please try again later.'
            ], 429);
        }

        // Check if limit is exceeded
        $failedAttempts = LoginAttempt::getFailedAttempts($email, $lockoutDuration);
        if ($failedAttempts >= $maxAttempts) {
            if ($user) {
                $user->update(['locked_until' => now()->addMinutes($lockoutDuration)]);
            }

            LoginAttempt::recordFailed($email, $ipAddress, 'Account locked');

            return response()->view('auth.login', [
                'error' => "Too many failed login attempts. Your account is locked for {$lockoutDuration} minutes."
            ], 429);
        }

        $response = $next($request);

        // If login was successful, record it
        if ($response->status() === 302 && $response->headers->get('Location') && !strpos($response->headers->get('Location'), 'login')) {
            if ($user) {
                $user->update(['locked_until' => null]);
                LoginAttempt::recordSuccess($email, $ipAddress);
            }
        } else {
            // Record failed attempt
            LoginAttempt::recordFailed($email, $ipAddress, 'Invalid credentials');
        }

        return $response;
    }
}
