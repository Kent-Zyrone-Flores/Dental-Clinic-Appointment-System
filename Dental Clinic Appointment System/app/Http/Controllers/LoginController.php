<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller {
    public function login() {
        return view('login'); 
    }
    

    public function submit(Request $request) {
        $incoming_fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        Login::create($incoming_fields);

        return redirect()->route('user')->with('success', 'Account created successfully. Please log in.');
    }
}
