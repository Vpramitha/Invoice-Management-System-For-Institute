<div x-data="{ open: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-20'"
        class="h-full bg-dark text-white flex flex-col min-h-screen transition-all duration-300">
        <button @click="open = !open" class="p-4 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Sidebar Navigation -->
        <nav class="flex flex-col space-y-4 mt-4 flex-grow overflow-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Dashboard</span>
            </a>

            <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Courses</span>
            </a>

            <a href="{{ route('students.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 12a4 4 0 1 0-8 0v2a4 4 0 0 0 3 3.87m6-3.87a4 4 0 0 1 8 0v2a4 4 0 0 1-3 3.87M9 20h6" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Students</span>
            </a>

            <a href="{{ route('payments.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M9 21V9m6 12V9" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Payments</span>
            </a>

            <a href="{{ route('brokers.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M12 7v12M5 7V3a2 2 0 012-2h10a2 2 0 012 2v4M5 7h14" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Brokers</span>
            </a>

            <a href="{{ route('report.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Reports</span>
            </a>

            <!-- Profile & Logout -->
            <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 hover:bg-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A8 8 0 1 1 18.879 6.196M15 14a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                </svg>
                <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Profile</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 hover:bg-gray-700 text-left">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    <span x-show="open" class="ml-2" x-transition:enter="transition-opacity duration-300">Logout</span>
                </button>
            </form>
        </nav>
    </div>
</div>