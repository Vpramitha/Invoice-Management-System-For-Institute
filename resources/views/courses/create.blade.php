<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('courses.store') }}" method="POST">
                                @csrf
                                
                                <!-- Student Name -->
                                <div class="mb-3">
                                    <label for="course_name" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" id="course_name" name="course_name" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" required>
                                </div>

                                <!-- Instructor -->
                                <div class="mb-3">
                                    <label for="instructor" class="form-label">Instructor</label>
                                    <input type="text" class="form-control" id="instructor" name="instructor" required>
                                </div>

                                <!-- Support Staff -->
                                <div class="mb-3">
                                    <label for="support_staff" class="form-label">Support Staff</label>
                                    <input type="text" class="form-control" id="support_staff" name="support_staff" required>
                                </div>
                                
                                    <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Create New Course</h4>
                <p class="text-muted mb-0">
                    You can Create a New Course here and the First batch of the Created Course.
                </p>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="course-name" class="form-label">Course Name</label>
                                <input type="text" id="course-name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="5"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="instructor" class="form-label">Instructor</label>
                                <input type="text" id="instructor" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="co-instructor" class="form-label">Co Instructor</label>
                                <input type="text" id="co-instructor" class="form-control">
                            </div>
                        </div>
                        <!-- End Left Column -->

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="batch" class="form-label">Batch</label>
                                <input type="number" class="form-control" id="batch" disabled value="1">
                                <small class="form-text text-muted">This applies only to the first batch. You can change
                                    these for the next batches as needed. 🚀</small>
                            </div>

                            <div class="mb-3">
                                <label for="course-price" class="form-label">Course Price</label>
                                <input class="form-control" id="course-price" type="number">
                                <small class="form-text text-muted">This applies only to the first batch. You can change
                                    these for the next batches as needed. 🚀</small>
                            </div>

                            <div class="mb-3">
                                <label for="registration-fee" class="form-label">Registration Fee</label>
                                <input class="form-control" id="registration-fee" type="number">
                                <small class="form-text text-muted">This applies only to the first batch. You can change
                                    these for the next batches as needed. 🚀</small>
                            </div>

                            <div class="mb-3">
                                <label for="start-date" class="form-label">Start Date</label>
                                <input class="form-control" id="start-date" type="date">
                                <small class="form-text text-muted">This applies only to the first batch. You can change
                                    these for the next batches as needed. 🚀</small>
                            </div>
                        </div>
                        <!-- End Right Column -->

                        <!-- Submit Button (Aligned to Right) -->
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                    <!-- End Row -->
                </form>
            </div>
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

</x-app-layout>
