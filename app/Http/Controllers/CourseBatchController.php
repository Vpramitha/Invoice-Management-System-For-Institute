<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseBatch;
use App\Models\StudentCourseBatch;
use App\Models\Installment;
use Illuminate\Http\Request;

class CourseBatchController extends Controller
{
    // Display the form for creating a new course batch
    public function create($id)
    {
        // Fetch the specific course by ID
        $course = Course::findOrFail($id);

        // Fetch all batch courses where 'course_id' matches the given ID
        $batches = CourseBatch::where('course_id', $id)->get();

        // Return the view with the course and batches
        return view('batch.create', compact('course', 'batches'));
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
            'num_of_installments'=>'required|numeric',
        ]);

        // Create a new course batch
        $courseBatch = CourseBatch::create([
            'course_id' => $request->course_id,
            'batch' => $request->batch,
            'course_price' => $request->course_price,
            'registration_fee' => $request->registration_fee,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_month' => $request->start_month,
        ]);

        $courseBatchId = $courseBatch->id; // Get the ID

        // Create installments plan
        $installmentAmount = $request->course_price / $request->num_of_installments;
        for ($i = 1; $i <= $request->num_of_installments; $i++) {
            Installment::create([
                'course_batch_id' => $courseBatchId,
                'installment' => $i,
                'amount' => $installmentAmount,
            ]);
        }

        // Redirect with a success message
        return redirect()->route('courses.batches', $request->course_id)->with('success', 'Batch created successfully!');
    }

    public function registeredStudents($courseId, $batchId)
    {
        // Fetch the course
        $course = Course::findOrFail($courseId);

        $batch = CourseBatch::findOrFail($batchId);

        $students = StudentCourseBatch::where('course_batch_id', $batchId)
            ->with('student') // Ensure this relationship is defined correctly
            ->get();


        // Return the view with course, batch, and students
        return view('batch.registeredStudents', compact('course', 'batch', 'students'));
    }

}
