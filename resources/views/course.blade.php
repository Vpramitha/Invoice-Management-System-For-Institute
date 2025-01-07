<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Insert') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-center mb-4">Course Insert Form</h3>
                    
                    <!-- Registration Form in a Bootstrap Card -->
                    <div class="card shadow-lg p-3 mb-5 bg-dark rounded">
                        <div class="card-body">
                            <form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="course_name">Course Name</label>
        <input type="text" name="course_name" id="course_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="instructor">Instructor</label>
        <input type="text" name="instructor" id="instructor" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="support_staff">Support Staff</label>
        <input type="text" name="support_staff" id="support_staff" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Course</button>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
