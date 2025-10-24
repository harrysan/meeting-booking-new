<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Simple hardcoded admin credentials
        if ($request->email === 'admin@company.com' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        session()->forget('admin_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
