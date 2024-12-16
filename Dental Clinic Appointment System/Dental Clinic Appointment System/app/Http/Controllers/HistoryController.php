<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class HistoryController extends Controller
{
    public function index() {
        // Fetch the appointments from the database
        $appointments = Appointment::all();
        
        // Calculate total revenue
        $totalRevenue = $appointments->sum('price'); // assuming 'price' is a column in the 'appointments' table
         
        // Pass the appointments data and total revenue to the view
        return view('history', ['appointments' => $appointments, 'totalRevenue' => $totalRevenue]);
    }
}
