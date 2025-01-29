<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Batches Of the ') }}{{ $course->course_name }}
</h2>

    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->course_name }}</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <a href="{{ route('batches.create',$course->id)}}" class="btn btn-primary mb-4">Add New Batch</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Batch</th>
                            <th class="px-4 py-2">Course Price for Batch</th>
                            <th class="px-4 py-2">Start_date</th>
                            
                            
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($batches as $batch)
                            <tr>
                                <td class="border px-4 py-2">{{ $batch->id }}</td> <!-- Use the ID -->
                                <td class="border px-4 py-2">{{ $batch->batch }}</td>
                                <td class="border px-4 py-2">{{ $batch->course_price }}</td>
                                <td class="border px-4 py-2">{{ $batch->start_date }}</td>
                                
                               
                                <td class="border px-4 py-2">
                                    <a href="{{ route('course.batch.registeredStudents', ['course' => $course->id, 'batch' => $batch->id]) }}" class="btn btn-primary">Registered Students</a>

                                    
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
