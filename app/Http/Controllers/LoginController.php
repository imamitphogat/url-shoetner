<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            $request->session()->regenerate();

            // Redirect based on the user role
            $role = Auth::user()->role_id;
            if ($role == 1) {
                return redirect()->route('superadmin.dashboard')->with('success', 'Welcome Super Admin!');
            } elseif ($role == 2) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } elseif ($role == 3) {
                return redirect()->route('member.urls.index')->with('success', 'Welcome Member!');
            }

            return redirect('/')->with('error', 'Invalid role. Contact the administrator.');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
