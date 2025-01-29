<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('export.users') }}" class="btn btn-primary mb-4">Download user report</a>
                <a href="{{ route('export.payments') }}" class="btn btn-primary mb-4">Download payment report</a>

               
               

            </div>
        </div>
    </div>


  


</x-app-layout>