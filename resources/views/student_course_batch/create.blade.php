<div class="container">
    <h2>Register Student for Course Batch</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('student_course_batch.store') }}" method="POST">
        @csrf

        <!-- Student Selection (Drop-down) -->
        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select a student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Course Batch Selection (Drop-down) -->
        <div class="form-group">
            <label for="course_batch_id">Select Course Batch</label>
            <select name="course_batch_id" id="course_batch_id" class="form-control" required>
                <option value="">Select a course batch</option>
                @foreach($courseBatches as $courseBatch)
                    <option value="{{ $courseBatch->id }}">{{ $courseBatch->batch }} ({{ $courseBatch->course->name }})</option>
                @endforeach
            </select>
            @error('course_batch_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Registration Fee -->
        <div class="form-group">
            <label for="registration_fee">Registration Fee</label>
            <input type="number" name="registration_fee" id="registration_fee" class="form-control" step="0.01" required>
            @error('registration_fee')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Full Payment -->
        <div class="form-group">
            <label for="full_payment">Full Payment</label>
            <select name="full_payment" id="full_payment" class="form-control" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            @error('full_payment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Register Student</button>
    </form>
</div>