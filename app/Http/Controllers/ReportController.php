<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Payment;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('report.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportUsers()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');

        // Fetch data from database
        $users = \App\Models\User::all();
        $row = 2;

        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $row++;
        }

        // Save to file and return download response
        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path('app/public/users.xlsx');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPayments()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Student Id');
        $sheet->setCellValue('C1', 'Student Name');
        $sheet->setCellValue('D1', 'Course Id');
        $sheet->setCellValue('E1', 'Course Name');
        $sheet->setCellValue('F1', 'Payment Amount');
        $sheet->setCellValue('G1', 'Paid Date');
        $sheet->setCellValue('H1', 'Installment');

        // Fetch data from the payments table
        $payments = Payment::with('studentCourseBatch.student', 'studentCourseBatch.courseBatch.course')->get();
        $row = 2;

        foreach ($payments as $payment) {
            $sheet->setCellValue('A' . $row, $payment->id);
            $sheet->setCellValue('B' . $row, $payment->studentCourseBatch->student->id);
            $sheet->setCellValue('C' . $row, $payment->studentCourseBatch->student->name);
            $sheet->setCellValue('D' . $row, $payment->studentCourseBatch->courseBatch->Course->id);
            $sheet->setCellValue('E' . $row, $payment->studentCourseBatch->courseBatch->Course->course_name);
            $sheet->setCellValue('F' . $row, $payment->payment_amount);
            $sheet->setCellValue('G' . $row, $payment->paid_date);
            $sheet->setCellValue('H' . $row, $payment->installment);
            $row++;
        }

        // Save to file and return download response
        $fileName = 'payments.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
