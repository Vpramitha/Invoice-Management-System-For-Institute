<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <!-- Cards Section -->
                <div class="container my-5">
                    <div class="row justify-content-center">
                       <!-- Register a Student Card -->
<div class="col-md-4">
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#register'">
        <div class="card-body text-center">
            <div class="container">
                <h1>Search Students</h1>

                <!-- Simple Search Form -->
                <form id="searchForm" method="POST" >
                    @csrf
                    <div class="form-group mt-3">
                        <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Enter Student ID">
                    </div>

                    <!-- Advanced Search Toggle as a Link -->
                    <a href="javascript:void(0);" id="advancedSearchLink" class="text-decoration-none text-secondary">
                        Advanced Search
                    </a>

                    <div id="advancedSearchForm" style="display: none;">
                        <p>Enter any of these details to search for a student:</p>
                        <div class="form-group mt-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Student Name">
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Student Email">
                        </div>
                    </div>

                    <button type="button" id="searchButton" class="btn btn-success mt-3 mx-2">Search</button>
                </form>
            </div>

            <!-- JavaScript to Toggle Advanced Search -->
            <script>
                // Toggle Advanced Search Form
                document.getElementById('advancedSearchLink').addEventListener('click', function () {
                    var advancedForm = document.getElementById('advancedSearchForm');
                    if (advancedForm.style.display === "none") {
                        advancedForm.style.display = "block";
                    } else {
                        advancedForm.style.display = "none";
                    }
                });

                // Handle Search Button Click
                document.getElementById('searchButton').addEventListener('click', function () {
                    var advancedForm = document.getElementById('advancedSearchForm');
                    var searchForm = document.getElementById('searchForm');

                    if (advancedForm.style.display === "none") {
                        // Normal Search: Only Student ID
                        var studentId = document.getElementById('student_id').value;
                        searchForm.action = "{{ route('students.search.normal') }}"; // Replace with your normal search route
                        searchForm.method = "POST";

                        // Only submit if Student ID is provided
                        if (studentId.trim() !== "") {
                            searchForm.submit();
                        } else {
                            alert("Please enter a Student ID for a normal search.");
                        }
                    } else {
                        // Advanced Search: Name and/or Email
                        var name = document.getElementById('name').value;
                        var email = document.getElementById('email').value;
                        searchForm.action = "{{ route('students.search.advanced') }}"; // Replace with your advanced search route
                        searchForm.method = "POST";

                        // At least one of Name or Email must be provided
                        if (name.trim() !== "" || email.trim() !== "") {
                            searchForm.submit();
                        } else {
                            alert("Please enter at least a Name or Email for an advanced search.");
                        }
                    }
                });
            </script>

            <a href="{{ route('students.create') }}" class="btn btn-primary mt-3">Add New Student</a>
            <a href="{{ route('students.index') }}" class="btn btn-primary mt-3">All Students</a>
        </div>
    </div>
</div>

                        <!-- Insert a Course Card -->
                  <!--      <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" onclick="window.location.href='#course'">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Insert a Course</h5>
                                    <p class="card-text">Enter course details and add it to the system.</p>
                                    <a href="{{ route('courses.create') }}" class="btn btn-success">Insert Course</a>
                                    <a href="{{ route('courses.index') }}" class="btn btn-success">Courses</a>
                                </div>
                            </div>
                        </div>
                        
                    -->
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
