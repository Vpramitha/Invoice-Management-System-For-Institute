<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

use App\Models\CourseBatch;

class CourseController extends Controller
{
    // Display the list of courses
    public function index()
    {
        $courses = Course::paginate(10);
        return view('courses.index', compact('courses'));
    }

    // Show the form for creating a new course
    public function create()
    {
        return view('courses.create');
    }

    // Store a newly created course
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'course_name' => 'required|string|max:255',
                'description' => 'required|string',
                'instructor' => 'required|string|max:255',
                'support_staff' => 'required|string|max:255',
            ]);

            // Create the course
            Course::create($request->all());

            // Redirect with success message
            return redirect()->route('courses.index')->with('success', 'Course created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions specifically
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle general exceptions
            return redirect()->route('courses.create')->with('error', 'An error occurred while creating the course. Please try again later.');
        }
    }

    // Show the form for editing a course
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Update the specified course
    public function update(Request $request, Course $course)
    {
        try {
            // Validate the request data
            $request->validate([
                'course_name' => 'required|string|max:255',
                'description' => 'required|string',
                'instructor' => 'required|string|max:255',
                'support_staff' => 'required|string|max:255',
            ]);

            // Update the course
            $course->update($request->all());

            // Redirect with success message
            return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions specifically
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle general exceptions
            return redirect()->route('courses.edit')->with('error', 'An error occurred while updating the course. Please try again later.');
        }
    }


    // Remove the specified course
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('courses.index')->with('error', 'An error occurred while deleting the student.');
        }
    }

    public function batches($id)
    {
        try {
            // Retrieve the course using the provided ID
            $course = Course::findOrFail($id);

            // Retrieve the course batches associated with the course
            $batches = CourseBatch::where('course_id', $id)->get();

            // Return the view with the course and batches data
            return view('courses.batches', compact('course', 'batches'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where the course is not found
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        } catch (\Exception $e) {
            // Handle general exceptions (e.g., database errors)
            return redirect()->route('courses.index')->with('error', 'An error occurred while fetching the course batches. Please try again later.');
        }
    }

}
