<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Course') }}
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
