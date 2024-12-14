<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signup;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    public function login() {
        return view('login'); // Return your login form view
    }

    public function submit(Request $request) {
        // Validate login input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists
        $user = Signup::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            // Redirect back with an error message if authentication fails
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        // Store user in session (if applicable) and redirect to user page
        session(['user_id' => $user->id]); // Example session storage
        return redirect()->route('user')->with('success', 'Logged in successfully!');
    }
}
