<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('payments.create') }}" class="btn btn-primary mb-4">Create New Payment</a>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Course</th>
                            <th class="px-4 py-2">Batch</th>
                            <th class="px-4 py-2">Installment</th>
                            <th class="px-4 py-2">Payment</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="border px-4 py-2">{{ $payment->id }}</td>
                                <td class="border px-4 py-2">
                                    {{ $payment->studentCourseBatch->student->name ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $payment->studentCourseBatch->courseBatch->course->course_name ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $payment->studentCourseBatch->courseBatch->batch ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">{{ $payment->installment }}</td>
                                <td class="border px-4 py-2">{{ $payment->payment_amount }}</td>
                                <td class="border px-4 py-2">{{ $payment->paid_date ? \Carbon\Carbon::parse($payment->paid_date)->format('Y-m-d') : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payments->links() }}
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