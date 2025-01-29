<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-center mb-4">Student Registration Form</h3>
                    
                    <!-- Registration Form in a Bootstrap Card -->
                    <div class="card shadow-lg p-3 mb-5 bg-dark rounded">
                        <div class="card-body">
                            <form action="{{ route('students.store') }}" method="POST">
                                @csrf
                                
                                <!-- Student Name -->
                                <div class="mb-3">
                                    <label for="student_name" class="form-label">Student Name</label>
                                    <input type="text" class="form-control" id="student_name" name="name" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Registration Fee -->
                                <div class="mb-3">
                                    <label for="registration_fee" class="form-label">Registration Fee</label>
                                    <input type="number" class="form-control" id="registration_fee" name="registration_fee" required>
                                </div>

                                <!-- Course Selection -->
                                <div class="mb-3">
                                    <label for="course" class="form-label">Select Course</label>
                                    <select class="form-select" id="course" name="course" required>
                                        <option value="course1">Course 1</option>
                                        <option value="course2">Course 2</option>
                                        <option value="course3">Course 3</option>
                                    </select>
                                </div>

                                <!-- Batch Selection -->
                                <div class="mb-3">
                                    <label for="batch" class="form-label">Select Batch</label>
                                    <select class="form-select" id="batch" name="batch" required>
                                        <option value="batch1">Batch 1</option>
                                        <option value="batch2">Batch 2</option>
                                        <option value="batch3">Batch 3</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Register Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
