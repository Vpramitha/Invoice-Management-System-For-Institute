<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\CourseBatch;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourseBatch;
use Illuminate\Http\Request;

class StudentCourseBatchController extends Controller
{
    // Show the form for creating a new registration
    public function create()
    {
        // Fetch all students and course batches
        $students = Student::all();
        $courseBatches = CourseBatch::all();

        // Return the view with the students and course batches
        return view('student_course_batch.create', compact('students', 'courseBatches'));
    }

    // Store a new student course registration
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_batch_id' => 'required|exists:course_batches,id',
            'registration_fee' => 'required|numeric',
            'full_payment' => 'required|boolean',
        ]);

        // Create a new student course batch registration
        StudentCourseBatch::create([
            'student_id' => $request->student_id,
            'course_batch_id' => $request->course_batch_id,
            'registration_fee' => $request->registration_fee,
            'full_payment' => $request->full_payment,
        ]);

        // Redirect with a success message
        return redirect()->route('students.courses', $request->student_id)->with('success', 'Student successfully registered for the course batch!');
    }

    public function studentRegister()
    {
        // Fetch all courses with their related course batches
        $courses = Course::all();

        // Return the view with the courses and course batches
        return view('student_course_batch.test', compact('courses'));
    }
}

