<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a  class="btn btn-primary mb-4">Register for new Course</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                <th>Batch Name</th>
                <th>Course Price</th>
                <th>Registration Fee</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($registeredCourses as $studentCourseBatch)
                            <tr>
                                <td>{{ $studentCourseBatch->courseBatch->course->course_name }}</td>
                    <td>{{ $studentCourseBatch->courseBatch->batch }}</td>
                    <td>{{ $studentCourseBatch->courseBatch->course_price }}</td>
                    <td>{{ $studentCourseBatch->registration_fee }}</td>
                                <td class="border px-4 py-2">
                                    
                                    <a class="btn btn-info">Payments</a>
                                                                   
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
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
