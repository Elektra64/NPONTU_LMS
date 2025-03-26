<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    </script>
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
    <!-- Main Dashboard Layout -->
    <div class="flex flex-col min-h-screen">
        <!-- Top Navigation Bar -->
        <nav class="bg-fine-color shadow-md z-10 fixed w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <a href="/" class="flex items-center px-3 py-2 text-white hover:bg-accent-light rounded-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('courses') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
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
            <!-- Top Header -->
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-accent-dark">Admin Dashboard</h1>
                <div class="text-sm text-gray-500">
                    Last updated: <span id="lastUpdatedTime">Just now</span>
                </div>
            </header>

            <!-- Dashboard Statistics -->
            <div class="grid sm:grid-cols-4 gap-6 mb-6">
                <!-- Total Courses Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 3H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM12 7v10M7 12h10"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Total Courses</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="totalCourses">42</p>
                    <p class="text-sm text-green-600 mt-2">+5 this month</p>
                </div>

                <!-- Active Users Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="2" x2="12" y2="12"></line>
                            <line x1="12" y1="12" x2="16" y2="8"></line>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Active Users</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="activeUsers">1,256</p>
                    <div class="flex items-center mt-2">
                        <span class="text-sm text-green-600 mr-2">+12% growth</span>
                        <span class="text-xs text-gray-500">(24h)</span>
                    </div>
                </div>

                <!-- Course Enrollments Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h18v18H3z"></path>
                            <path d="M12 7v10"></path>
                            <path d="M7 12h10"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Course Enrollments</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="courseEnrollments">587</p>
                    <div class="flex justify-between mt-2">
                        <span class="text-sm text-green-600">Completed: 500</span>
                        <span class="text-sm text-yellow-600">Pending: 87</span>
                    </div>
                </div>

                <!-- Total Quizzes Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v2M12 18v2M4 12h2M16 12h2M7 5l2 2M17 5l-2 2M7 19l2-2M17 19l-2-2"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Total Quizzes</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="totalQuizzes">25</p>
                    <p class="text-sm text-green-600 mt-2">25 Assessments created</p>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-6 mb-6">
                <!-- Recent Courses Section -->
                <div class="bg-white rounded-lg shadow-md lg:col-span-2">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-accent-dark">Recent Courses</h2>
                        <a href="{{ route('courses') }}" class="text-green-600 hover:underline">View All</a>
                    </div>
                    <div id="courseGrid" class="grid md:grid-cols-2 gap-6 p-6">
                        <!-- Course cards will be dynamically inserted here -->
                    </div>
                </div>

                <!-- Recent Activities Section -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-accent-dark">Recent Activities</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New course published</p>
                                    <p class="text-sm text-gray-500">"Advanced JavaScript Patterns" was published by Admin</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New user registration</p>
                                    <p class="text-sm text-gray-500">John Doe registered as a student</p>
                                    <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Quiz completed</p>
                                    <p class="text-sm text-gray-500">Sarah completed "HTML Basics" quiz with 92% score</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">System update</p>
                                    <p class="text-sm text-gray-500">Platform updated to version 2.3.1</p>
                                    <p class="text-xs text-gray-400 mt-1">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Enrollment Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-accent-dark mb-4">Course Enrollments</h2>
                    <canvas id="enrollmentChart"></canvas>
                </div>

                <!-- User Activity Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-accent-dark mb-4">User Activity</h2>
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Course Details Modal -->
    <div id="courseDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 id="courseDetailsTitle" class="text-2xl font-bold text-accent-dark">Course Details</h2>
                <button onclick="closeDetailsModal()" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="courseDetailsContent" class="p-6">
                <!-- Course details will be loaded here dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Course Data - Synced with course management page

    </script>
</body>
</html>
