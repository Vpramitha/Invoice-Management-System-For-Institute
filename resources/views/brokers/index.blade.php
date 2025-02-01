<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('brokers.create') }}" class="btn btn-primary mb-4">Add New Broker</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">email</th>
                            <th class="px-4 py-2">NIC</th>
                            <th class="px-4 py-2">Contact Number</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brokers as $broker)
                            <tr>
                                <td class="border px-4 py-2">{{ $broker->id }}</td> 
                                <td class="border px-4 py-2">{{ $broker->name }}</td>
                                <td class="border px-4 py-2">{{ $broker->email }}</td>
                                <td class="border px-4 py-2">{{ $broker->nic }}</td>
                                <td class="border px-4 py-2">{{ $broker->mobile_number }}</td>

                                <td class="border px-4 py-2">
                                    <a class="btn btn-primary">Cost Report</a>

                                    <a href="{{ route('brokers.edit', $broker->id) }}" class="btn btn-warning">Edit</a>

                                    
                                    <form id="delete-form-{{ $broker->id }}" action="{{ route('brokers.destroy', $broker->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $broker->id }})">Delete</button>
                                    </form>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
{{ $brokers->links() }}
                
            </div>
        </div>
    </div>-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="header-title">Brokers</h4>
                        <p class="text-muted mb-0">
                            All of the students are shown here, and you can take actions for the courses using the buttons
                            in
                            front of
                            the student.
                        </p>
                    </div>
                    <a href="{{ route('brokers.create') }}" class="btn btn-primary">Add New Broker</a>
                </div>
    
                <div class="card-body">
                    <table id="scroll-vertical-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th >Name</th>
                                <th >email</th>
                                <th >NIC</th>
                                <th >Contact Number</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
    
    
                        <tbody>
                            @foreach ($brokers as $broker)
                                <tr>
                                    <td >{{ $broker->id }}</td> <!-- Use the ID -->
                                    <td >{{ $broker->name }}</td>
                                    <td >{{ $broker->email }}</td>
                                    <td >{{ $broker->nic }}</td>
                                    <td >{{ $broker->mobile_number }}</td>

                                    <td >
                                        <a class="btn btn-primary">Cost Report</a>

                                        <a href="{{ route('brokers.edit', $broker->id) }}" class="btn btn-warning">Edit</a>

                                        <!-- The 'Reject' button will trigger SweetAlert and form submission -->
                                        <form id="delete-form-{{ $broker->id }}" action="{{ route('brokers.destroy', $broker->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $broker->id }})">Delete</button>
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
        function confirmDelete(brokerId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This broker will be deleted and the action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to delete the broker
                    document.getElementById('delete-form-' + brokerId).submit();
                }
            });
        }
    </script>


</x-app-layout>
