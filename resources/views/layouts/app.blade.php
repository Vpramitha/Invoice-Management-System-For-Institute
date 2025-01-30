<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            /* Adjust as needed */
            z-index: 10;
            background-color: #2d3748;
            /* Sidebar color */
        }

        .sidebar a {
    margin-bottom: 1rem; /* Add space between items */
}

/* Optional: You can also add padding for better spacing inside each item */
.sidebar a:hover {
    padding: 0.8rem; /* Optional, adjust as needed */
}
    
        /* Main header (Top bar) */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 5;
            background-color: #fff;
            box-shadow: 0 4px 2px -2px gray;
            padding: 1rem;
        }
    
        /* Main content area */
        .content {
            margin-left: 250px;
            /* Same width as sidebar */
            margin-top: 100px;
            /* Adjust for header height */
            padding: 20px;
            overflow-y: auto;
            flex-grow: 1;
        }
    
        /* Footer */
        footer {
            background-color: #fff;
            padding: 1rem;
            box-shadow: 0 -4px 2px -2px gray;
        }
    </style>
    
</head>

<body class="font-sans antialiased">
    <div x-data="{ open: false, dropdownOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div :class="open ? 'w-64' : 'w-20'"
            class="h-full bg-dark text-white flex flex-col min-h-screen transition-all duration-300" >
            <button @click="open = !open" class="p-4 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <nav class="flex flex-col space-y-4 mt-4 flex-grow" style="height: 100vh;">
                
             <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z" />
                    </svg>
                    <span x-show="open" class="ml-2">Dashboard</span>
                </a>
                <!--
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <img src="{{ asset('data.png') }}" alt="Dashboard Icon" class="w-10 h-8">
                    <span x-show="open" class="ml-2">Dashboard</span>
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <img src="{{ asset('courses.png') }}" alt="Courses Icon" class="w-10 h-8">
                    <span x-show="open" class="ml-2">Courses</span>
                </a>-->
               <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                    </svg>
                    <span x-show="open" class="ml-2">Courses</span>
                </a>

                <a href="{{ route('students.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 12a4 4 0 1 0-8 0v2a4 4 0 0 0 3 3.87m6-3.87a4 4 0 0 1 8 0v2a4 4 0 0 1-3 3.87M9 20h6" />
                    </svg>
                    <span x-show="open" class="ml-2">Students</span>
                </a>

                <!--<a href="{{ route('students.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <img src="{{ asset('students.png') }}" alt="Students Icon" class="w-10 h-8">
                    <span x-show="open" class="ml-2">Students</span>
                </a>-->
                <a href="{{ route('payments.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M9 21V9m6 12V9" />
                    </svg>
                    <span x-show="open" class="ml-2">Payments</span>
                </a>
            <a href="{{ route('brokers.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M12 7v12M5 7V3a2 2 0 012-2h10a2 2 0 012 2v4M5 7h14" />
                </svg>
                <span x-show="open" class="ml-2">Brokers</span>
            </a>


                <a href="{{ route('report.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
                    </svg>
                    <span x-show="open" class="ml-2">Reports</span>
                </a>
                <!-- Profile & Logout in Sidebar -->
                <a  class="flex items-center px-4 py-2 hover:bg-gray-700 mt-auto">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A8 8 0 1 1 18.879 6.196M15 14a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                    <span x-show="open" class="ml-2">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}"
                    class="flex items-center px-4 py-2 hover:bg-gray-700">
                    @csrf
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    <button class="w-full text-left" x-show="open">Log Out</button>
                </form>
                
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white dark:bg-gray-800 shadow p-4 flex flex-col">
                <!-- Main Header: Academy Image, Name, and Date/Time -->
                <div class="flex justify-between items-center mb-2">
                    <!-- Left Section: Academy Image and Name -->
                    <div class="flex items-center">
                        <img src="{{ asset('logo.png') }}" alt="Academy Logo" class="h-20 mr-2">

                        <div class="text-lg font-semibold">ABC Academy <br/>Colombo <br/>Sri lanka</div>
                    </div>
            
                    <!-- Right Section: Date and Time -->
                    <div class="text">
                        <div id="current-time" class="text-right"></div>
                    </div>
                </div>
            
                <!-- Sub-topic bar at the bottom of the header -->
                <!-- 
                <div class="bg-light dark:bg-dark-700 py-2 text-center text-sm font-semibold text-black dark:text-black">
                    {{ $header ?? 'Dashboard' }}
                </div>
                -->
                
            </header>
            
            <script>
                // Function to update the current date and time
                function updateTime() {
                    const now = new Date();
                    const date = now.toLocaleDateString();
                    const time = now.toLocaleTimeString();
                    document.getElementById("current-time").textContent = `${date} - ${time}`;
                }
                setInterval(updateTime, 1000); // Update every second
                updateTime(); // Initial call to display the time immediately
            </script>


            <main class="p-6 flex-grow overflow-auto">
                {{ $slot }}
            </main>
            <footer class="bg-white dark:bg-gray-800 p-4 text-center shadow-md w-full fixed bottom-0">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </footer>
        </div>
    </div>

    <style>
        .fixed-bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #1a202c;
            /* Adjust the color as needed */
            color: white;
            padding: 1rem;
            text-align: center;
        }
    </style>
</body>

</html>