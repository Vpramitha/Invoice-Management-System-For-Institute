<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\PaymentInvoice;
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
            'studentId' => 'required',
            'invoiceId' => 'required',
        ]);

        // Create a new payment record and get the instance
        $payment = Payment::create([
            'student_course_batch_id' => $request->student_course_batch_id,
            'payment_amount' => $request->payment_amount,
            'paid_date' => $request->paid_date,
            'installment' => $request->installment,
        ]);

        // Retrieve the ID of the newly created record
        $newPaymentId = $payment->id;

        // Create a new invoice record
        $invoiceId = $this->createInvoice($request->invoiceId,$newPaymentId);

        // Redirect back to the payments page with updated data and a success message
        return redirect()
            ->route('students.payments', [$request->studentId, $invoiceId])
            ->with([
                'success' => 'Payment successfully recorded!',
            ]);
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

    public function printInvoice($invoiceId)
    {
        // Fetch the latest payment records for the student_course_batch
        $invoice = Invoice::with(['paymentInvoices','paymentInvoices.payment.studentCourseBatch', 'paymentInvoices.payment.studentCourseBatch.courseBatch.course', 'paymentInvoices.payment.studentCourseBatch.student'])
            ->findOrFail($invoiceId);
        return view('invoice.invoice', compact('invoice'));
    }

    public function createInvoice($invoiceId, $PaymentId)
    {
        // If $invoiceId is 0, create a new invoice
        if ($invoiceId == 0) {
            // Get the logged-in user's ID
            $loggedUserId = auth()->id();

            // Create a new invoice with status 'pending' and associate it with the logged-in user
            $invoice = Invoice::create([
                'status' => 'pending',
                'user_id' => $loggedUserId,
            ]);

            // Get the newly created invoice ID
            $invoiceId = $invoice->id;
        }

        // Create the PaymentInvoice relationship entry
        PaymentInvoice::create([
            'payment_id' => $PaymentId,
            'invoice_id' => $invoiceId,
        ]);

        // Return the invoice ID (or you can return the invoice object if you need more details)
        return $invoiceId;
    }

}
