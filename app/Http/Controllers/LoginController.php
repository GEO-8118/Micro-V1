<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function show()
    {
        return view('login');
    }

    /**
     * Handle a login request.
     */
    public function store(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Authentication passed
            $request->session()->regenerate();
            $user = Auth::user();

            if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'profile_completed') && ! $user->profile_completed) {
                return redirect()->route('profile.complete')->with('info', 'Please complete your profile before continuing.');
            }

            // Role-based default redirect
            $role = (int) ($user->role_id ?? 3);
            $routeName = match ($role) {
                1 => 'admin.dashboard',
                2 => 'faculty.dashboard',
                default => 'dashboard',
            };

            return redirect()->intended(route($routeName))->with('success', 'Welcome back!');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle a logout request.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->with('success', 'You have been logged out.');
    }
}
