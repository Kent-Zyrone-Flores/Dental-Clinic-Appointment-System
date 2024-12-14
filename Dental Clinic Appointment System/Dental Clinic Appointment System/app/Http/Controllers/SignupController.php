<?php

namespace App\Http\Controllers;

use App\Models\Signup;
use Illuminate\Http\Request;

class SignupController extends Controller {
    public function signup() {
        return view('signup'); 
    }

    public function save(Request $request) {

        $incoming_fields = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'password' => 'required',
        ]);

        Signup::create($incoming_fields);
        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');

    }
}