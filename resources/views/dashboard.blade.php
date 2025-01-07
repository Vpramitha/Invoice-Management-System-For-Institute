<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <!-- Cards Section -->
                <div class="container my-5">
                    <div class="row justify-content-center">
                        <!-- Register a Student Card -->
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#register'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Register a Student</h5>
                                    <p class="card-text">Fill out the form to register a student.</p>
                                    <a href="{{ route('studentRegister') }}" class="btn btn-primary">Register</a>
                                    <a href="{{ route('students.index') }}" class="btn btn-primary">Students</a>

                                </div>
                            </div>
                        </div>
                        <!-- Insert a Course Card -->
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#course'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Insert a Course</h5>
                                    <p class="card-text">Enter course details and add it to the system.</p>
                                    <a href="{{ route('courses.create') }}" class="btn btn-success">Insert Course</a>
                                    <a href="{{ route('courses.index') }}" class="btn btn-success">Courses</a>
                                </div>
                            </div>
                        </div>
                        <!-- Payments Card -->
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#payment'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Payments</h5>
                                    <p class="card-text">Manage student payments and fees.</p>
                                    <a href="{{ route('payments.create')}}" class="btn btn-warning">Manage Payments</a>
                                </div>
                            </div>
                        </div>

                        <!-- Batch register -->
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#payment'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Batch</h5>
                                    <p class="card-text">Manage student payments and fees.</p>
                                    <a href="{{ route('course_batches.create') }}" class="btn btn-warning">insert batch</a>
                                </div>
                            </div>
                        </div>

                        <!-- Batch register -->
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#payment'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Student Batch</h5>
                                    <p class="card-text">Manage student payments and fees.</p>
                                    <a href="{{ route('student_course_batch.create') }}" class="btn btn-warning">insert batch</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
