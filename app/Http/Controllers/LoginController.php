<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    public function login() {
        return view('login'); 
    }

    public function submit(Request $request) {
        $incoming_fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Check if the email exists in the database
        $user = User::where('email', $incoming_fields['email'])->first();
    
        if (!$user || !Hash::check($incoming_fields['password'], $user->password)) {
            return back()->with('error', 'Invalid email or password.');
        }
    
        // Authentication successful
        session(['user' => $user->id]); // Store user id in session
        return redirect()->route('user')->with('success', 'Logged in successfully.');
    }
    
}