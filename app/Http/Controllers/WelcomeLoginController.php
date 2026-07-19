<?php

namespace App\Http\Controllers;

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
            'role' => 'required|in:admin,staff',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'admin' => ['username' => 'systemadmin@gmail.com', 'password' => 'admin123'],
            'staff' => ['username' => 'staff@gmail.com', 'password' => 'staff123'],
        ];

        $role = $request->input('role');
        $valid = $credentials[$role] ?? null;

        if ($valid && $request->username === $valid['username'] && $request->password === $valid['password']) {
            session([
                'welcome_dashboard_logged_in' => true,
                'welcome_dashboard_role' => $role,
            ]);

            if ($role === 'admin') {
                return redirect()->route('admin.welcome');
            }

            return redirect('/');
        }

        return back()
            ->withInput($request->only('username', 'role'))
            ->withErrors(['login' => 'Invalid username, password, or role.']);
    }
    
}
