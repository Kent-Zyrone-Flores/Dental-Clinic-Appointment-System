<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller {
    public function signup() {
        return view('signup'); 
    }

    public function save(Request $request) {
        $incoming_fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:signups,email',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Hash the password before saving it
        $incoming_fields['password'] = Hash::make($incoming_fields['password']);

        User::create($incoming_fields);

        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }
}
