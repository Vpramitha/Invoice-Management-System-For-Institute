<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>
<!--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Add New Course</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Course</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Instructor</th>
                            <th class="px-4 py-2">Support Staff</th>
                            
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="border px-4 py-2">{{ $course->id }}</td> 
                                <td class="border px-4 py-2">{{ $course->course_name }}</td>
                                <td class="border px-4 py-2">{{ $course->description }}</td>
                                <td class="border px-4 py-2">{{ $course->instructor }}</td>
                                <td class="border px-4 py-2">{{ $course->support_staff }}</td>
                               
                                <td class="border px-4 py-2">
                                    <a href="{{ route('courses.batches', $course->id) }}" class="btn btn-primary">Batches</a>
                                    
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>

                                    
                                    <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $course->id }})">Delete</button>
                                    </form>

                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="header-title">Courses</h4>
                        <p class="text-muted mb-0">
                            All of the courses are shown here, and you can take actions for the courses using the buttons in front of
                            the course.
                        </p>
                    </div>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
                </div>

                <div class="card-body">
                    <table id="scroll-vertical-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Description</th>
                                <th>Instructor</th>
                                <th>Support Staff</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
    
    
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td >{{ $course->id }}</td> <!-- Use the ID -->
                                    <td >{{ $course->course_name }}</td>
                                    <td >{{ $course->description }}</td>
                                    <td >{{ $course->instructor }}</td>
                                    <td >{{ $course->support_staff }}</td>

                                    <td >
                                        <a href="{{ route('courses.batches', $course->id) }}" class="btn btn-primary">Batches</a>

                                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>

                                        <!-- The 'Reject' button will trigger SweetAlert and form submission -->
                                        <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $course->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach          
                        </tbody>
                    </table>
    
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div><!-- end row-->

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


<!-- SweetAlert Confirmation Script for Delete -->
    <script>
        function confirmDelete(courseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This course will be deleted and the action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to delete the student
                    document.getElementById('delete-form-' + courseId).submit();
                }
            });
        }
    </script>
    

</x-app-layout>
