<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Active Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/users.js') }}"></script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F7FAFC;
        }
        ::-webkit-scrollbar-thumb {
            background: #4A5568;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-background min-h-screen">
    <!-- Top Navigation Bar -->
    <nav class="bg-fine-color shadow-md z-10 w-full px-4 sm:px-6 lg:px-8 ">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo and title -->
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h1 class="text-xl font-bold text-accent-dark">EduVerse</h1>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4">
                        <a href="/" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('courses') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light  rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.09a1 1 0 01.44 1.352l-2.101 4.63A1.518 1.518 0 004.412 16.2l.314-.1a1.036 1.036 0 00.707-.88V9.82a1 1 0 00-.293-.707L3.31 9.09z" />
                            </svg>
                            Courses
                        </a>
                        <a href="{{ route('quizzes') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            Quizzes
                        </a>
                        <a href="{{ route('users') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17 10c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm-10 0c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm10 2c-2.67 0-8 1.336-8 4v2h16v-2c0-2.664-5.33-4-8-4zm-10 0c-.354 0-.689.031-1 .078-2.243.375-4 1.659-4 3.922v2h6v-2c0-.747.213-1.374.547-1.953-.812-.307-1.791-.547-2.547-.547z"/>
                            </svg>
                            Users
                        </a>
                        <a href="{{ route('home') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 3v2h4.586L8.293 15.293l1.414 1.414L20 6.414V11h2V3h-8zM4 5v16h16v-6h2v8H2V5h2z"/>
                            </svg>
                            View Site
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button and logout -->
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="flex items-center px-3 py-2 text-red-600 hover:bg-red-100 rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L14.586 9H7a1 1 0 110-2h7.586l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="hidden md:inline">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 m-8 animate-fade-in mt-16">
        <!-- User Management Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-accent-dark mb-2">Active Users</h1>
                <p class="text-gray-600">View currently logged-in users</p>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <!-- Refresh Button -->
                <button id="refreshUsers" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Users Table Header -->
            <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 bg-gray-50 text-sm font-medium text-gray-600">
                <div class="col-span-4">User</div>
                <div class="col-span-3">Email</div>
                <div class="col-span-2">Role</div>
                <div class="col-span-2">Login Time</div>
                <div class="col-span-1">Session</div>
            </div>

            <!-- User Items -->
            <div id="userList">
                <!-- Active users will be loaded here dynamically -->
            </div>

            <!-- Loading State -->
            <div id="loadingIndicator" class="p-8 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary"></div>
                <p class="mt-2 text-gray-600">Loading active users...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No active users</h3>
                <p class="mt-1 text-gray-500">There are currently no logged-in users.</p>
            </div>
        </div>
    </main>
</body>
</html>
