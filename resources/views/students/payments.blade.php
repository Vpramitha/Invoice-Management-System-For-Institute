<x-app-layout>

    <!-- Include SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // Extract the invoice ID safely
        var invoiceId = {{ $invoice_Payments && $invoice_Payments->isNotEmpty() && $invoice_Payments->first()->invoice->id ? $invoice_Payments->first()->invoice->id : 0 }};

        if (invoiceId > 0) {
            // Push a new state to the history stack
            history.pushState(null, null, location.href);

            // Listen for the popstate event
            window.addEventListener('popstate', function (event) {
                // Prevent back navigation
                history.pushState(null, null, location.href);

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "If you go back, it will delete all payment details associated with this invoice. Do you really want to leave?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete and go back',
                    cancelButtonText: 'No, stay on this page',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the cancel invoice route only if the invoice ID is valid
                        window.location.href = `/payment/delete/invoice/${invoiceId}`;
                    } else {
                        console.log("User chose to stay on the page.");
                    }
                });
            });
        }
    </script>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments for ') . $student->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card shadow-lg p-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Payments for {{ $student->name }}</h3>
                </div>
                 @if (isset($studentCourseBatches) && $studentCourseBatches->isNotEmpty())
                                                        <div class="card-body">
                                                            @foreach ($studentCourseBatches as $batch)
                                                                                                    <div class="mb-4">
                                                                                                        <h4 class="text-secondary">
                                                                                                            <strong>Course: {{ $batch->courseBatch->course->course_name }} (Batch:
                                                                                                                {{ $batch->courseBatch->batch }})</strong>
                                                                                                        </h4>

                                                                                                        <!-- Installments Section -->
                                                                                                        <div class="row">
                                                                                                            @php
        $paidInstallments = $courseBatchPayments[$batch->id]->pluck('installment')->toArray() ?? [];
        $highlighted = false;
                                                                                                            @endphp

                                                                                                            @foreach ($batch->courseBatch->installments as $installment)
                                                                                                                @if (!in_array($installment->installment, $paidInstallments))
                                                                                                                    <div class="col-md-4 mb-3">
                                                                                                                        <div class="card {{ !$highlighted ? 'border-success' : '' }}">
                                                                                                                            <div class="card-body">
                                                                                                                                <h5 class="card-title">Installment #{{ $installment->installment }}</h5>
                                                                                                                                <p class="card-text">Amount: <strong>{{ $installment->amount }}</strong></p>
                                                                                                                                <p class="card-text">
                                                                                                                                    Due Date: {{ $installment->due_date ?? 'Not Specified' }}
                                                                                                                                </p>

                                                                                                                                @if (!$highlighted)
                                                                                                                                    <p class="text-success fw-bold">Next Installment to Pay</p>
                                                                                                                                    <!-- Trigger for Bootstrap Modal -->
                                                                                                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                                                                                                        data-bs-target="#paymentModal"
                                                                                                                                        data-installment="{{ $installment->installment }}"
                                                                                                                                        data-amount="{{ $installment->amount }}"
                                                                                                                                        data-batch="{{ $batch->courseBatch->batch }}"
                                                                                                                                        data-batch-id="{{ $batch->id }}"
                                                                                                                                        data-course="{{ $batch->courseBatch->course->course_name }}">
                                                                                                                                        Pay Now
                                                                                                                                    </button>
                                                                                                                                    @php $highlighted = true; @endphp
                                                                                                                                @endif
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                @endif
                                                                                                            @endforeach

                                                                                                            @if ($batch->courseBatch->installments->whereNotIn('installment', $paidInstallments)->isEmpty())
                                                                                                                <p class="text-success">All installments are paid for this course batch.</p>
                                                                                                            @endif
                                                                                                        </div>

                                                                                                        <!-- Payments Section -->
                                                                                                        @if (isset($courseBatchPayments[$batch->id]) && $courseBatchPayments[$batch->id]->isNotEmpty())
                                                                                                            <table class="table table-bordered table-striped mt-4">
                                                                                                                <thead class="thead-dark">
                                                                                                                    <tr>
                                                                                                                        <th scope="col">Payment ID</th>
                                                                                                                        <th scope="col">Installment</th>
                                                                                                                        <th scope="col">Amount</th>
                                                                                                                        <th scope="col">Date</th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody>
                                                                                                                    @foreach ($courseBatchPayments[$batch->id] as $payment)
                                                                                                                        <tr>
                                                                                                                            <td>{{ $payment->id }}</td>
                                                                                                                            <td>{{ $payment->installment }}</td>
                                                                                                                            <td>{{ $payment->payment_amount }}</td>
                                                                                                                            <td>{{ $payment->paid_date ? $payment->paid_date : 'N/A' }}</td>
                                                                                                                        </tr>
                                                                                                                    @endforeach
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        @else
                                                                                                            <p class="text-warning">No payments found for this course batch.</p>
                                                                                                        @endif
                                                                                                    </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payment Modal -->
                                            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="paymentModalLabel">Process Payment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('payments.store') }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="course" class="form-label">Course</label>
                                                                    <input type="text" id="course" class="form-control" value="{{ $batch->courseBatch->course->course_name }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="batch" class="form-label">Batch</label>
                                                                    <input type="text" id="batch" class="form-control" value="{{ $batch->courseBatch->batch }}" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="installment" class="form-label">Installment #</label>
                                                                    <input type="text" id="installment" name="installment" class="form-control"
                                                                        value="{{ $nextInstallment->installment ?? 'N/A' }}" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="amount" class="form-label">Amount</label>
                                                                    <input type="text" id="amount" name="payment_amount" class="form-control"
                                                                        value="{{ $nextInstallment->amount ?? 'N/A' }}" readonly>
                                                                </div>
                                                                <input type="hidden" id="batchId" name="student_course_batch_id" value="{{ $batch->id }}">
                                                                <input type="hidden" name="studentId" value="{{ $student->id }}">
                                                                <input type="hidden" name="invoiceId" value="{{ $invoice_Payments && $invoice_Payments->isNotEmpty() ? $invoice_Payments->first()->invoice->id ?? 0 : 0 }}">
                                                                <input type="hidden" name="paid_date" value="{{ now()->format('Y-m-d') }}">
                                                                <button type="submit" class="btn btn-success w-100">Pay Now</button>
                                                            </form>

                                                        </div>
                @else
                    <div class="card-body">
                        <p class="text-warning">No registered course batches found for this student.</p>
                    </div>

             @endif
            </div>
        </div>
    </div>

    <!-- Include Bootstrap (if not already included in your layout) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to Populate Modal -->
    <script>
        const paymentModal = document.getElementById('paymentModal');
        paymentModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const course = button.getAttribute('data-course');
            const batch = button.getAttribute('data-batch');
            const batchId = button.getAttribute('data-batch-id');
            const installment = button.getAttribute('data-installment');
            const amount = button.getAttribute('data-amount');

            paymentModal.querySelector('#course').value = course;
            paymentModal.querySelector('#batch').value = batch;
            paymentModal.querySelector('#batchId').value = batchId;
            paymentModal.querySelector('#installment').value = installment;
            paymentModal.querySelector('#amount').value = amount;
        });
    </script>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="cart-container" id="cartContainer">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Invoice</h5>
            </div>
            <div class="cart-body p-2">
                <!-- Cart Items -->
                @if($invoice_Payments && $invoice_Payments->isNotEmpty())
                                                <ul class="list-unstyled">
                                                    @php
    $totalAmount = $invoice_Payments->sum(function ($paymentInvoice) {
        return $paymentInvoice->payment->payment_amount;
    });
                                                    @endphp

                                                    @foreach($invoice_Payments as $paymentInvoice)
                                                        <li class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                                            <div>
                                                                <span
                                                                    class="d-block font-weight-bold">{{ $paymentInvoice->payment->studentCourseBatch->courseBatch->course->course_name }}</span>
                                                                <small class="text-muted">Batch
                                                                    {{ $paymentInvoice->payment->studentCourseBatch->courseBatch->batch }}</small>
                                                            </div>
                                                            <span
                                                                    class="d-block font-weight-bold">installment {{ $paymentInvoice->payment->installment }}</span>
                                                            <span class="text-success font-weight-bold">Rs.
                                                                {{ number_format($paymentInvoice->payment->payment_amount, 2) }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                @else
                    <p class="text-center text-muted">No payments found.</p>
                @endif
            </div>
            <div class="cart-footer p-3 bg-light d-flex justify-content-between align-items-center rounded-bottom">
                <p class="mb-0 h6">Total: <strong>Rs. {{ number_format($totalAmount ?? 0, 2) }}</strong></p>
                 @if($invoice_Payments && $invoice_Payments->isNotEmpty())
                    <a href="{{ route('payment.invoice', ['invoiceId' => $invoice_Payments->first()->invoice->id]) }}" target="_blank" class="btn btn-primary btn-sm">
                        Print Invoice
                    </a>
                @endif
            </div>
        </div>

    </div>
    
    <!-- Button to Toggle Cart Visibility -->
    <button id="toggleCartBtn" class="toggle-cart-btn btn btn-primary rounded-circle p-2">
        🛒
    </button>
    
    <script>
        // Toggle Cart Visibility
        document.getElementById('toggleCartBtn').addEventListener('click', function () {
            const cart = document.getElementById('cartContainer');
            cart.classList.toggle('hidden');
        });

        // Close Cart
        document.getElementById('closeCartBtn').addEventListener('click', function () {
            const cart = document.getElementById('cartContainer');
            cart.classList.add('hidden');
        });
    </script>
<style>
    /* Cart container styles */
.cart-container {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 400px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease-in-out;
}

/* Cart Body */
.cart-body {
    max-height: 250px;
    overflow-y: auto;
}

/* Cart Footer */
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

/* Button to close cart */
.close-cart {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

/* Cart Toggle Button */
.toggle-cart-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    padding: 15px;
    font-size: 24px;
    cursor: pointer;
}

/* Hidden class for hiding the cart */
.hidden {
    visibility: hidden;
    opacity: 0;
}

</style>



</x-app-layout>