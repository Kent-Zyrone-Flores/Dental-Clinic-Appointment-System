<?php

namespace App\Http\Controllers;

use App\Models\Signup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller {
    public function signup() {
        return view('signup'); 
    }

    public function save(Request $request) {
        // Validate incoming fields
        $incoming_fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:signups,email', // Ensure email is unique
            'phone' => 'required',
            'password' => 'required', // Add minimum password length for security
        ]);

        // Encrypt the password
        $incoming_fields['password'] = Hash::make($incoming_fields['password']);

        // Save the user to the database
        Signup::create($incoming_fields);

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }
}
