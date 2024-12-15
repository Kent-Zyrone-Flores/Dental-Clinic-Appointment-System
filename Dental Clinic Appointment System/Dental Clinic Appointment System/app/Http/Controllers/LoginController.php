<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login view.
     */
    public function login()
    {
        return view('login'); // Render the login view
    }

    /**
     * Handle login form submission.
     */
    public function submit(Request $request)
    {
        // Validate incoming request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user using the default 'web' guard
        if (Auth::guard('web')->attempt($credentials)) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            $user = Auth::guard('web')->user(); // Retrieve authenticated user

            // Redirect based on user role
            if ($user->is_admin == 1) {
                // If the user is an admin, redirect to the dashboard
                return redirect()->route('dashboard')->with('success', 'Welcome, Admin!');
            } else {
                // If the user is not an admin, redirect to the user page
                return redirect()->route('user')->with('success', 'Welcome back!');
            }
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // Retain the email input
    }
}
