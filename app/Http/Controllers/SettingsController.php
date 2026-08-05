<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use App\Models\EquipmentSetting;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Show the settings page
     */
    public function index()
    {
        $equipmentSettings = EquipmentSetting::all();
        
        // Fetch system settings
        $systemSettings = [
            'session_timeout_minutes' => SystemSetting::get('session_timeout_minutes', 30),
            'max_login_attempts' => SystemSetting::get('max_login_attempts', 5),
            'lockout_duration_minutes' => SystemSetting::get('lockout_duration_minutes', 15),
            'auto_mark_unavailable' => SystemSetting::get('auto_mark_unavailable', 1),
            'enable_login_rules' => SystemSetting::get('enable_login_rules', 1),
        ];

        $currentUser = auth()->user();

        if (!$currentUser) {
            $currentUser = (object) [
                'id' => null,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => null,
                'bio' => null,
            ];
        }

        // Get login attempts for current admin
        $recentLoginAttempts = LoginAttempt::where('email', $currentUser->email)
            ->orderBy('attempted_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.settings', compact(
            'equipmentSettings',
            'systemSettings',
            'recentLoginAttempts',
            'currentUser'
        ));
    }

    /**
     * Update equipment settings
     */
    public function updateEquipmentSettings(Request $request)
    {
        $validated = $request->validate([
            'equipment_notes' => 'array',
            'equipment_notes.*' => 'nullable|string',
        ]);

        foreach ($validated['equipment_notes'] ?? [] as $equipmentId => $notes) {
            $equipment = EquipmentSetting::find($equipmentId);
            if ($equipment) {
                $equipment->notes = $notes;
                $equipment->save();
            }
        }

        return back()->with('success', 'Equipment settings updated successfully!');
    }

    /**
     * Update security settings
     */
    public function updateSecuritySettings(Request $request)
    {
        $validated = $request->validate([
            'session_timeout_minutes' => 'required|integer|min:5|max:1440',
            'max_login_attempts' => 'required|integer|min:3|max:20',
            'lockout_duration_minutes' => 'required|integer|min:5|max:1440',
            'enable_login_rules' => 'nullable|boolean',
            'auto_mark_unavailable' => 'nullable|boolean',
        ]);

        SystemSetting::set('session_timeout_minutes', $validated['session_timeout_minutes']);
        SystemSetting::set('max_login_attempts', $validated['max_login_attempts']);
        SystemSetting::set('lockout_duration_minutes', $validated['lockout_duration_minutes']);
        SystemSetting::set('enable_login_rules', $validated['enable_login_rules'] ? 1 : 0);
        SystemSetting::set('auto_mark_unavailable', $validated['auto_mark_unavailable'] ? 1 : 0);

        return back()->with('success', 'Security settings updated successfully!');
    }

    /**
     * Update admin account settings
     */
    public function updateAccountSettings(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return back()->with('success', 'Account information updated successfully!');
    }

    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]+$/',
        ], [
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ]);

        $user = auth()->user();

        // Check current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update(['password' => Hash::make($validated['new_password'])]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Toggle equipment auto-mark unavailable setting
     */
    public function toggleAutoMarkUnavailable(Request $request)
    {
        $validated = $request->validate([
            'auto_mark_unavailable' => 'required|boolean',
        ]);

        SystemSetting::set('auto_mark_unavailable', $validated['auto_mark_unavailable'] ? 1 : 0);

        return response()->json([
            'success' => true,
            'message' => 'Auto-mark unavailable setting updated!',
        ]);
    }

    /**
     * Toggle enable login rules setting
     */
    public function toggleLoginRules(Request $request)
    {
        $validated = $request->validate([
            'enable_login_rules' => 'required|boolean',
        ]);

        SystemSetting::set('enable_login_rules', $validated['enable_login_rules'] ? 1 : 0);

        return response()->json([
            'success' => true,
            'message' => 'Login rules setting updated!',
        ]);
    }
}
