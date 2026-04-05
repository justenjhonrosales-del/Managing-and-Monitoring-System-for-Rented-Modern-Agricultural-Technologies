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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $validUsername = 'AgriTech2026';
        $validPassword = 'admin123';

        if ($request->username === $validUsername && $request->password === $validPassword) {
            session(['welcome_dashboard_logged_in' => true]);
            return redirect('/');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['login' => 'Invalid username or password.']);
    }
    
}
