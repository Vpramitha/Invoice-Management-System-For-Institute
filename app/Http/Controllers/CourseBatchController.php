<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBatch;
use Illuminate\Http\Request;

class CourseBatchController extends Controller
{
    // Display the form for creating a new course batch
    public function create()
    {
        // Fetch all courses from the 'courses' table
        $courses = Course::all();

        // Return the view with the courses
        return view('course_batches.create', compact('courses'));
    }

    // Store a new course batch
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch' => 'required|string|max:255',
            'course_price' => 'required|numeric',
            'registration_fee' => 'required|numeric',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'start_month' => 'nullable|string|max:255',
        ]);

        // Create a new course batch
        CourseBatch::create([
            'course_id' => $request->course_id,
            'batch' => $request->batch,
            'course_price' => $request->course_price,
            'registration_fee' => $request->registration_fee,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_month' => $request->start_month,
        ]);

        // Redirect with a success message
        return redirect()->route('course_batches.create')->with('success', 'Batch created successfully!');
    }
}
