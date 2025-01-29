
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Course batch Registration') }}
        </h2>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-center mb-4">batch Registration Form</h3>
                    
                    <!-- Registration Form in a Bootstrap Card -->
                    <div class="card shadow-lg p-3 mb-5 bg-dark rounded">
                        <div class="card-body">
<div class="container">
    <h2>Create a New Course Batch</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('course_batches.store') }}" method="POST">
        @csrf

        <!-- Course Selection (Drop-down) -->
        <div class="form-group">
            <label for="course_id">Select Course</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">Select a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Batch Name -->
        <div class="form-group">
            <label for="batch">Batch Name</label>
            <input type="text" name="batch" id="batch" class="form-control" required>
            @error('batch')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Course Price -->
        <div class="form-group">
            <label for="course_price">Course Price</label>
            <input type="number" name="course_price" id="course_price" class="form-control" step="0.01" required>
            @error('course_price')
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

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date">Start Date (Optional)</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Start Month -->
        <div class="form-group">
            <label for="start_month">Start Month (Optional)</label>
            <input type="text" name="start_month" id="start_month" class="form-control">
            @error('start_month')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Batch</button>
    </form>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>