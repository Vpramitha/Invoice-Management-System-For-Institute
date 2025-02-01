<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('export.users') }}" class="btn btn-primary mb-4">Download user report</a>
                <a href="{{ route('export.payments') }}" class="btn btn-primary mb-4">Download payment report</a>

               
               

            </div>
        </div>
    </div>-->




    <div class="row">
        <div class="col-12">
            <h4 class="mb-4 mt-2">Reports</h4>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    
    <div class="row">
        <div class="col-md-4">
            <div class="card border-secondary border">
                <div class="card-body">
                    <h5 class="card-title">User Report</h5>
                    <p class="card-text">All the users on the system</p>
                    <a href="{{ route('export.users') }}" class="btn btn-secondary btn-sm">Download User Report</a>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    
        <div class="col-md-4">
            <div class="card border-primary border">
                <div class="card-body">
                    <h5 class="card-title text-primary">Payment Report</h5>
                    <p class="card-text">All the payments done through out the system</p>
                    <a href="{{ route('export.payments') }}" class="btn btn-primary btn-sm">Download Payment Report</a>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    
        
    </div>
    <!-- end row -->


  


</x-app-layout>