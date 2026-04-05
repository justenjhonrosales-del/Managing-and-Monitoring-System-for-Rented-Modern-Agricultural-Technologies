<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $table = 'login_attempts';
    protected $fillable = ['email', 'ip_address', 'success', 'reason'];
    public $timestamps = false;

    protected $casts = [
        'attempted_at' => 'datetime',
    ];

    /**
     * Record a failed login attempt
     */
    public static function recordFailed($email, $ipAddress, $reason = 'Invalid credentials')
    {
        return self::create([
            'email' => $email,
            'ip_address' => $ipAddress,
            'success' => false,
            'reason' => $reason,
            'attempted_at' => now(),
        ]);
    }

    /**
     * Record a successful login attempt
     */
    public static function recordSuccess($email, $ipAddress)
    {
        return self::create([
            'email' => $email,
            'ip_address' => $ipAddress,
            'success' => true,
            'attempted_at' => now(),
        ]);
    }

    /**
     * Get failed attempts for email in last N minutes
     */
    public static function getFailedAttempts($email, $minutesBack = 15)
    {
        return self::where('email', $email)
            ->where('success', false)
            ->where('attempted_at', '>=', now()->subMinutes($minutesBack))
            ->count();
    }

    /**
     * Get failed attempts for IP address in last N minutes
     */
    public static function getFailedAttemptsFromIp($ipAddress, $minutesBack = 15)
    {
        return self::where('ip_address', $ipAddress)
            ->where('success', false)
            ->where('attempted_at', '>=', now()->subMinutes($minutesBack))
            ->count();
    }
}
