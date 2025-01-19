
<div class="container">
    <form method="POST" >
        @csrf
        <div class="form-group">
            <label for="course">Select Course</label>
            <select id="course" name="course_id" class="form-control">
                <option value="">-- Select a Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="course_batch">Select Course Batch</label>
            <select id="course_batch" name="course_batch_id" class="form-control" disabled>
                <option value="">-- Select a Course Batch --</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script>
    document.getElementById('course').addEventListener('change', function() {
        const courseId = this.value;
        const courseBatchSelect = document.getElementById('course_batch');

        // Clear the course batch dropdown
        courseBatchSelect.innerHTML = '<option value="">-- Select a Course Batch --</option>';

        if (courseId) {
            fetch(`/api/course/${courseId}/batches`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        courseBatchSelect.disabled = false;
                        data.forEach(batch => {
                            const option = document.createElement('option');
                            option.value = batch.id;
                            option.textContent = batch.batch;
                            courseBatchSelect.appendChild(option);
                        });
                    } else {
                        courseBatchSelect.disabled = true;
                    }
                });
        } else {
            courseBatchSelect.disabled = true;
        }
    });
</script>

