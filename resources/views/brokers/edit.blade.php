<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Broker Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('brokers.update', $broker->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Broker Name -->
                    <div class="form-group mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Broker Name</label>
                        <input type="text" name="name" id="name" class="form-control mt-1 block w-full"
                            value="{{ old('name', $broker->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="form-control mt-1 block w-full"
                            value="{{ old('email', $broker->email) }}" required>
                    </div>

                    <!-- NIC -->
                    <div class="form-group mb-4">
                        <label for="nic" class="block text-sm font-medium text-gray-700">NIC</label>
                        <input type="text" name="nic" id="nic" class="form-control mt-1 block w-full"
                            value="{{ old('nic', $broker->nic) }}" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group mb-4">
                        <label for="mobile_number" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="mobile_number" id="mobile_number"
                            class="form-control mt-1 block w-full"
                            value="{{ old('mobile_number', $broker->mobile_number) }}" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Broker Details</button>
                    </div>
                </form>
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