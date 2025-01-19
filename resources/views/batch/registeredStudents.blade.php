
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Registered Students for batch ') }}{{$batch->batch}}{{' of the '}}{{ $course->course_name }}
</h2>

    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $course->course_name }} Batch {{$batch->batch}}</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <a  class="btn btn-primary mb-4">Add New Student</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Paid Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="border px-4 py-2">{{ $student->student->id }}</td> <!-- Use the ID -->
                                <td class="border px-4 py-2">{{ $student->student->name }}</td>
                                <td class="border px-4 py-2">{{ $student->student->email }}</td>
                                <td class="border px-4 py-2"></td>
                                
                               
                                
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
