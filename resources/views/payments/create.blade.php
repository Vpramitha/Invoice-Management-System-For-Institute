<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-center mb-4">Payment Form</h3>
<div class="container">
    <h2>Make Payment for Course Batch</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <!-- Student Course Batch Information (Readonly) -->
        <div class="form-group">
            <label for="student_course_batch_id">Student Course Batch</label>
            <input type="text" class="form-control" value="{{ $studentCourseBatch->courseBatch->batch }} ({{ $studentCourseBatch->student->name }})" readonly>
            <input type="hidden" name="student_course_batch_id" value="{{ $studentCourseBatch->id }}">
        </div>

        <!-- Payment Amount -->
        <div class="form-group">
            <label for="payment_amount">Payment Amount</label>
            <input type="number" name="payment_amount" id="payment_amount" class="form-control" step="0.01" required>
            @error('payment_amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Paid Date -->
        <div class="form-group">
            <label for="paid_date">Paid Date</label>
            <input type="date" name="paid_date" id="paid_date" class="form-control" required>
            @error('paid_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Installment Number (Optional) -->
        <div class="form-group">
            <label for="installment">Installment</label>
            <input type="number" name="installment" id="installment" class="form-control">
            @error('installment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Record Payment</button>
    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
