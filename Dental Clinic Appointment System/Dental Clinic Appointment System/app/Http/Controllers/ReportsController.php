<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // Display reports and handle search if a query is provided
    public function index(Request $request)
{
    $query = $request->input('search');
    $reports = Reports::where('title', 'LIKE', "%$query%")
        ->orWhere('status', 'LIKE', "%$query%")
        ->orWhere('date', 'LIKE', "%$query%")
        ->get();

    return view('reports', ['appointments' => $reports]); // This line should be corrected
}


    // Store new report
    public function store(Request $request)
    {
        // Validate the incoming fields
        $incoming_fields = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date',  // Ensure the date is in a valid format
        ]);

        // Create a new report
        Reports::create($incoming_fields);

        // Redirect back to reports index page
        return redirect()->route('reports.index'); // Assuming you have a route named reports.index
    }

    // Update a report
    public function update(Request $request, $id)
    {
        // Find the report by ID
        $report = Reports::findOrFail($id);

        // Validate the incoming fields
        $report->update($request->validate([
            'title' => 'required',
            'status' => 'required',
            'date' => 'required|date',
        ]));

        // Redirect back to the reports index page
        return redirect()->route('reports.index');
    }

    // Delete a report
    public function destroy($id)
    {
        // Find and delete the report
        $report = Reports::findOrFail($id);
        $report->delete();

        // Redirect back to the reports index page
        return redirect()->route('reports.index');
    }
}
