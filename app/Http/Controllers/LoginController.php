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
            $redirectRoute = route('dashboard');

            if ($user) {
                if ((int) $user->role_id === 1) {
                    $redirectRoute = route('admin.dashboard');
                } elseif ((int) $user->role_id === 2) {
                    $redirectRoute = route('faculty.dashboard');
                }
            }

            return redirect()->intended($redirectRoute)->with('success', 'Welcome back!');
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
