<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function appointments()
    {
        return view('appointments');
    }

    public function reports()
    {
        return view('reports');
    }

    public function history()
    {
        return view('history');
    }
}

