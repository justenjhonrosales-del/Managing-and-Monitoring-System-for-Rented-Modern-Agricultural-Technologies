<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class WelcomeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->input('username'))->first();

        if ($user && Hash::check($request->input('password'), $user->password) && in_array($user->role, ['admin', 'staff'], true)) {
            $role = $user->role;
            session([
                'welcome_dashboard_logged_in' => true,
                'welcome_dashboard_role' => $role,
                'welcome_dashboard_user_id' => $user->id,
            ]);

            if ($role === 'admin') {
                return redirect()->route('admin.welcome');
            }

            return redirect('/');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['login' => 'Invalid username or password.']);
    }
    
}
