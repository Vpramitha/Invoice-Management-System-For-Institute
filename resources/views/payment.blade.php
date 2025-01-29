<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-center mb-4">Payment Form</h3>
                    
                    <div class="container">
    <h2>Make Payment</h2>

    <!-- Display error messages if any -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Payment Form -->
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Enter student name" required>
        </div>

        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" name="course" id="course" class="form-control" placeholder="Enter course name" required>
        </div>

        <div class="form-group">
            <label for="payment_amount">Payment Amount:</label>
            <input type="number" name="payment_amount" id="payment_amount" class="form-control" placeholder="Enter payment amount" required>
        </div>

        <div class="form-group">
            <label for="month">Month:</label>
            <select name="month" id="month" class="form-control" required>
                <option value="">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
    </form>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
