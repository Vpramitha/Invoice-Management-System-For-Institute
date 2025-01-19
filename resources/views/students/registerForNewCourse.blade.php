<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register for new Courses') }}
        </h2>
    </x-slot>


<div class="container my-5">
    <h1 class="text-center text-primary mb-4">{{ $student->name }}</h1>
   <form method="POST" action="{{ route('student_course_batch.store') }}" class="p-4 shadow rounded" style="background-color: #f9f9f9;">
    @csrf

    <!-- Student Name -->
    <div class="form-group mb-3">
        <label for="student_name" class="form-label text-secondary">Student Name</label>
        <input 
            type="text" 
            id="student_name" 
            class="form-control border border-primary" 
            value="{{ $student->name }}" 
            readonly>
        <input 
            type="hidden" 
            name="student_id" 
            value="{{ $student->id }}">
    </div>

    <!-- Course Selection -->
    <div class="form-group mb-3">
        <label for="course" class="form-label text-secondary">Select Course</label>
        <select id="course" name="course_id" class="form-control border border-primary" required>
            <option value="">-- Select a Course --</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Course Batch Selection -->
    <div class="form-group mb-3">
        <label for="course_batch" class="form-label text-secondary">Select Course Batch</label>
        <select id="course_batch" name="course_batch_id" class="form-control border border-success" disabled>
            <option value="">-- Select a Course Batch --</option>
        </select>
    </div>

    <!-- Registration Fee -->
    <div class="form-group mb-3" id="registration-fee-group" style="display: none;">
        <label for="registration_fee" class="form-label text-secondary">Registration Fee</label>
        <input 
            type="text" 
            id="registration_fee" 
            name="registration_fee" 
            class="form-control border border-info" 
            readonly>
    </div>

    <!-- Full Payment Selection -->
    <div class="form-group mb-3" id="full-payment-group" style="display: none;">
        <label class="form-label text-secondary">Full Payment</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="full_payment" id="full_payment_yes" value="1">
            <label class="form-check-label" for="full_payment_yes">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="full_payment" id="full_payment_no" value="0">
            <label class="form-check-label" for="full_payment_no">No</label>
        </div>
    </div>

    <button type="submit" class="btn btn-success w-100 mt-3">Register</button>
</form>


    <!-- Batch Details Card -->
    <div id="batch-details-card" class="card mt-5 shadow" style="display: none; border: 2px solid #007bff;">
        <div class="card-header bg-primary text-white text-center">
            <h5>Batch Details</h5>
        </div>
        <div class="card-body" style="background-color: #e9f7fd;">
            <p><strong>Batch:</strong> <span id="batch-name" class="text-info"></span></p>
            <p><strong>Course Price:</strong> <span id="course-price" class="text-success"></span></p>
            <p><strong>Registration Fee:</strong> <span id="card-registration-fee" class="text-danger"></span></p>
            <p><strong>Description:</strong> <span id="description" class="text-secondary"></span></p>
            <p><strong>Start Date:</strong> <span id="start-date" class="text-warning"></span></p>
            <p><strong>Start Month:</strong> <span id="start-month" class="text-primary"></span></p>
        </div>
    </div>
</div>

<script>
    const courseSelect = document.getElementById('course');
    const batchSelect = document.getElementById('course_batch');
    const registrationFeeGroup = document.getElementById('registration-fee-group');
    const registrationFeeInput = document.getElementById('registration_fee');
    const fullPaymentGroup = document.getElementById('full-payment-group');
    const batchDetailsCard = document.getElementById('batch-details-card');

    courseSelect.addEventListener('change', function() {
        const courseId = this.value;

        // Reset fields and hide dynamic elements
        batchSelect.innerHTML = '<option value="">-- Select a Course Batch --</option>';
        batchSelect.disabled = true;
        registrationFeeGroup.style.display = 'none';
        fullPaymentGroup.style.display = 'none';
        batchDetailsCard.style.display = 'none';

        if (courseId) {
            fetch(`/api/course/${courseId}/batches`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        batchSelect.disabled = false;
                        data.forEach(batch => {
                            const option = document.createElement('option');
                            option.value = batch.id;
                            option.textContent = batch.batch;
                            batchSelect.appendChild(option);
                        });
                    }
                });
        }
    });

    batchSelect.addEventListener('change', function() {
        const batchId = this.value;

        // Hide dynamic elements
        registrationFeeGroup.style.display = 'none';
        fullPaymentGroup.style.display = 'none';
        batchDetailsCard.style.display = 'none';

        if (batchId) {
            fetch(`/api/batch/${batchId}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Populate registration fee and display the field
                        registrationFeeInput.value = data.registration_fee;
                        registrationFeeGroup.style.display = 'block';

                        // Display the full payment selection
                        fullPaymentGroup.style.display = 'block';

                        // Populate the batch details card
                        document.getElementById('batch-name').textContent = data.batch;
                        document.getElementById('course-price').textContent = data.course_price;
                        document.getElementById('card-registration-fee').textContent = data.registration_fee;
                        document.getElementById('description').textContent = data.description;
                        document.getElementById('start-date').textContent = data.start_date;
                        document.getElementById('start-month').textContent = data.start_month;

                        // Show the card
                        batchDetailsCard.style.display = 'block';
                    }
                });
        }
    });
</script>
</x-app-layout>