<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Student Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('name', $student->name) }}" 
                            required>
                    </div>

                    <!-- Name -->
                    <div class="form-group mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Student Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control mt-1 block w-full" 
                            value="{{ old('name', $student->email) }}" 
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