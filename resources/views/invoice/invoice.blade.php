<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .invoice-container {
            width: 210mm;
            margin: 20px auto;
            padding: 20mm;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .company-details {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .student-details,
        .invoice-meta {
            margin: 20px 0;
            font-size: 16px;
            color: #333;
        }

        .student-details p,
        .invoice-meta p {
            margin: 5px 0;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-details th,
        .invoice-details td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .invoice-details th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .total-section {
            margin-top: 20px;
            font-size: 18px;
            text-align: right;
            font-weight: bold;
        }

        .print-button-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn-print {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        /* A4 Printing */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                width: 100%;
                box-shadow: none;
                margin: 0;
            }

            .print-button-container {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <h1>Invoice</h1>
            <div class="company-details">
                <p><strong>Company Name:</strong> ABC Institute</p>
                <p><strong>Address:</strong> 123 Main Street, Colombo, Sri Lanka</p>
                <p><strong>Contact:</strong> +94 77 123 4567 | info@abcinstitute.com</p>
            </div>
        </div>

        <!-- Student Details -->
        <div class="student-details">
            <p><strong>Student Name:</strong>
                {{ $invoice->paymentInvoices->first()->payment->studentCourseBatch->student->name }}</p>
            <p><strong>Student ID:</strong>
                {{ $invoice->paymentInvoices->first()->payment->studentCourseBatch->student->id }}</p>
            <p><strong>Date:</strong> {{ date('Y-m-d') }}</p>
        </div>

        <!-- Invoice Meta -->
        <div class="invoice-meta">
            <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
        </div>

        <!-- Invoice Details Table -->
        <div class="invoice-details">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Batch</th>
                        <th>Installment</th>
                        <th>Payment Amount (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach($invoice->paymentInvoices as $index => $paymentInvoice)
                                        @php
                                            $payment = $paymentInvoice->payment;
                                            $totalAmount += $payment->payment_amount;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment->studentCourseBatch->courseBatch->course->course_name }}</td>
                                            <td>{{ $payment->studentCourseBatch->courseBatch->batch }}</td>
                                            <td>{{ $payment->installment }}</td>
                                            <td>{{ number_format($payment->payment_amount, 2) }}</td>
                                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <p>Total Amount: Rs. {{ number_format($totalAmount, 2) }}</p>
        </div>

        <!-- Print Button -->
        <div class="print-button-container">
            <button class="btn-print" onclick="printInvoice()">Print Invoice</button>
        </div>
    </div>

    <script>
        // Function to print the invoice
        function printInvoice() {
            window.print();
        }
    </script>
</body>

</html>