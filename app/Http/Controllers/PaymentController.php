<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentCourseBatch;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show the payment form for a student-course batch
    public function create()
    {
        // Fetch the specific student-course batch
        $studentCourseBatch = StudentCourseBatch::findOrFail(1);

        // Return the view with the student-course batch data
        return view('payments.create', compact('studentCourseBatch'));
    }

    // Store a new payment record
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'student_course_batch_id' => 'required|exists:student_course_batches,id',
            'payment_amount' => 'required|numeric',
            'paid_date' => 'required|date',
            'installment' => 'nullable|integer',
        ]);

        // Create a new payment record
        Payment::create([
            'student_course_batch_id' => $request->student_course_batch_id,
            'payment_amount' => $request->payment_amount,
            'paid_date' => $request->paid_date,
            'installment' => $request->installment,
        ]);

        // Redirect with a success message
        return redirect()->route('payments.create', $request->student_course_batch_id)->with('success', 'Payment successfully recorded!');
    }

    public function index()
    {
        // Eager load the related data for students, courses, and batches
        $payments = Payment::with([
            'studentCourseBatch.student',       // Load student details
            'studentCourseBatch.courseBatch.course', // Load course and batch details
        ])->paginate(10);

        return view('payments.index', compact('payments'));
    }


}
