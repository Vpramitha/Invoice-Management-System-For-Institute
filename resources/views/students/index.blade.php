<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('students.create') }}" class="btn btn-primary mb-4">Add Student</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="border px-4 py-2">{{ $student->id }}</td> 
                                <td class="border px-4 py-2">{{ $student->name }}</td>
                                <td class="border px-4 py-2">{{ $student->email }}</td>

                                <td class="border px-4 py-2">
                                    <a href="{{ route('students.courses', $student->id) }}" class="btn btn-primary">Courses</a>
                                    <a href="{{ route('students.payments', [$student->id, 0]) }}" class="btn btn-info">Payments</a>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>

                                    
                                    <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $student->id }})">Reject</button>
                                    </form>

                                    <a  href="{{ route('student.course.batch.register', $student->id) }}" class="btn btn-primary">Register for new Course</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
{{ $students->links() }}
                
            </div>
        </div>
    </div>-->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="header-title">Students</h4>
                        <p class="text-muted mb-0">
                            All of the students are shown here, and you can take actions for the courses using the buttons in
                            front of
                            the student.
                        </p>
                    </div>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
                </div>
    
                <div class="card-body">
                    <table id="scroll-vertical-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th=>
                                <th>Actions</th>
                            </tr>
                        </thead>
    
    
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td >{{ $student->id }}</td> <!-- Use the ID -->
                                    <td >{{ $student->name }}</td>
                                    <td >{{ $student->email }}</td>

                                    <td >
                                        <a href="{{ route('students.courses', $student->id) }}" class="btn btn-primary">Courses</a>
                                        <a href="{{ route('students.payments', [$student->id, 0]) }}" class="btn btn-info">Payments</a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>

                                        <!-- The 'Reject' button will trigger SweetAlert and form submission -->
                                        <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $student->id }})">Reject</button>
                                        </form>

                                        <a href="{{ route('student.course.batch.register', $student->id) }}" class="btn btn-primary">Register for new
                                            Course</a>

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

@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'warning',
            text: '{{ session('warning') }}',
            showConfirmButton: true
        });
    </script>
@endif



<!-- SweetAlert Confirmation Script for Delete -->
    <script>
        function confirmDelete(studentId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This student will be rejected and the action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to delete the student
                    document.getElementById('delete-form-' + studentId).submit();
                }
            });
        }
    </script>

</x-app-layout>
