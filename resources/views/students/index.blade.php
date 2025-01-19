<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                                <td class="border px-4 py-2">{{ $student->id }}</td> <!-- Use the ID -->
                                <td class="border px-4 py-2">{{ $student->name }}</td>
                                <td class="border px-4 py-2">{{ $student->email }}</td>
                               
                                <td class="border px-4 py-2">
                                    <a href="{{ route('students.courses', $student->id) }}" class="btn btn-primary">Courses</a>
                                    <a class="btn btn-info">Payments</a>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>

                                    <!-- The 'Reject' button will trigger SweetAlert and form submission -->
                                    <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $student->id }})">Reject</button>
                                    </form>

                                    <a  href="{{ route('student.course.batch.register',$student->id) }}" class="btn btn-primary">Register for new Course</a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
{{ $students->links() }}
                
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
