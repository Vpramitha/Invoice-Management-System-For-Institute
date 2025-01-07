<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group mb-4">
                        <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                        <input 
                            type="text" 
                            name="course_name" 
                            id="course_name" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('name', $course->course_name) }}" 
                            required>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input 
                            type="text" 
                            name="description" 
                            id="description" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('description', $course->description) }}" 
                            required>

                    </div>

                    <!-- Instructor -->
                    <div class="form-group mb-4">
                        <label for="instructor" class="block text-sm font-medium text-gray-700">Instructor</label>
                        <input 
                            type="text" 
                            name="instructor" 
                            id="instructor" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('instructor', $course->instructor) }}" 
                            required>
                    </div>

                    <!-- Support Staff -->
                    <div class="form-group mb-4">
                        <label for="support_staff" class="block text-sm font-medium text-gray-700">Support Staff</label>
                        <input 
                            type="text" 
                            name="support_staff" 
                            id="support_staff" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('support_staff', $course->support_staff) }}" 
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Student Details</button>
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