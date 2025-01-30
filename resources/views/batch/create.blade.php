<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Batch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('batches.store') }}" method="POST">
                                @csrf
                                
                                <!-- course Name -->
                               <div class="mb-3">
                                <!-- Display the course name as plain text -->
                                    <label for="course_name" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" id="course_name"  value="{{ $course->course_name }}" readonly>
    
                                     <!-- Hidden input to submit the course_id -->
                                    <input type="hidden" id="course_id" name="course_id" value="{{ $course->id }}">
                                </div>


                                <!-- Batch Input -->
<div class="mb-3">
    <label for="batch" class="form-label">Batch</label>
    <input type="text" class="form-control" id="batch" name="batch" required>
    <small id="batch-error" class="text-danger" style="display: none;">This batch already exists.</small>
</div>

                                <!-- Course Price -->
<div class="mb-3">
    <label for="course_price" class="form-label">Course Price</label>
    <input type="number" class="form-control" id="course_price" name="course_price" required step="0.01">
</div>

<!-- Registration fee -->
<div class="mb-3">
    <label for="registration_fee" class="form-label">Registration Fee</label>
    <input type="number" class="form-control" id="registration_fee" name="registration_fee" required step="0.01">
</div>


                                <!-- Description -->
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
</div>

<!-- Start Date -->
<div class="mb-3">
    <label for="start_date" class="form-label">Start Date</label>
    <input type="date" class="form-control" id="start_date" name="start_date" required>
</div>

<!-- Start Month -->
<div class="mb-3">
    <label for="start_month" class="form-label">Start Month</label>
    <select class="form-select" id="start_month" name="start_month" required>
        <option value="" disabled selected>Select Month</option>
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


<!-- Number of Installments -->
<div class="mb-3">
    <label for="num_of_installments" class="form-label">Number of Installments</label>
    <input type="number" class="form-control" id="num_of_installments" name="num_of_installments" required step="1">
</div>

                                
                                    <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert CDN in your head -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showConfirmButton: true
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    </script>
@endif

<script>
    // Pass existing batches from Laravel to JavaScript
    const existingBatches = @json($batches->pluck('batch'));

    document.getElementById('batch').addEventListener('input', function () {
        const batchInput = this.value.trim();
        const errorElement = document.getElementById('batch-error');

        // Check if input matches any existing batch
        if (existingBatches.includes(batchInput)) {
            errorElement.style.display = 'block'; // Show error message
            this.setCustomValidity('This batch already exists.'); // Prevent form submission
        } else {
            errorElement.style.display = 'none'; // Hide error message
            this.setCustomValidity(''); // Allow form submission
        }
    });
</script>

</x-app-layout>
