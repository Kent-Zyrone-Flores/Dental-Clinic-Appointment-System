<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller {
    public function user() {

        $appointments = Appointment::all();
        return view('user', compact('appointments'));
    }

    public function submit(Request $request) {
        $incoming_fields = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'service' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        Appointment::create($incoming_fields);

        return redirect()->route('user');
    }

    // Show all appointments
    public function index()
{
    $appointments = Appointment::all();
    return view('appointment', compact('appointments'));
}


    // Store a new appointment
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'service' => 'required|string',
            'amount' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointment');
    }
    
    public function updateStatus($id, Request $request)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['success' => false, 'message' => 'Appointment not found']);
        }

        // Update the status in the database
        $appointment->status = $request->input('status');
        $appointment->save();  // Save the updated appointment

        return response()->json(['success' => true]);
    }

    // Method to delete an appointment
    public function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['success' => false, 'message' => 'Appointment not found']);
        }

        // Delete the appointment from the database
        $appointment->delete();

        return response()->json(['success' => true]);
    }
}





