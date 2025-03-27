<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Quiz Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/quizzes.js') }}"></script>
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
        <!-- Quiz Management Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-accent-dark mb-2">Quiz Management</h1>
                <p class="text-gray-600">View and manage all course quizzes</p>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <!-- Search Field -->
                <div class="relative">
                    <input type="text" placeholder="Search quizzes..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quiz Filters -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                    <select id="courseFilter" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All Courses</option>
                        <!-- Will be populated dynamically -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quiz Type</label>
                    <select id="quizTypeFilter" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All Types</option>
                        <option value="module">Module Quiz</option>
                        <option value="final">Final Exam</option>
                    </select>
                </div>
                <button id="applyFilters" class="mt-6 bg-accent-light hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Quizzes Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Quizzes Table Header -->
            <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 bg-gray-50 text-sm font-medium text-gray-600">
                <div class="col-span-4">Quiz Title</div>
                <div class="col-span-3">Course</div>
                <div class="col-span-2">Type</div>
                <div class="col-span-2">Questions</div>
                <div class="col-span-1">Actions</div>
            </div>

            <!-- Quiz Items -->
            <div id="quizList">
                <!-- Quiz items will be dynamically inserted here -->
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center p-4 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium" id="totalQuizzes">0</span> quizzes
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Previous</button>
                    <button class="px-3 py-1 bg-primary text-white rounded-md hover:bg-secondary">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">2</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">3</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Quiz Preview Modal -->
    <div id="quizPreviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 id="quizPreviewTitle" class="text-2xl font-bold text-accent-dark">Quiz Preview</h2>
                <button id="closePreviewModal" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="quizPreviewContent" class="p-6">
                <!-- Quiz content will be loaded here dynamically -->
            </div>
        </div>
    </div>

    <!-- Quiz Attempt Modal -->
    <div id="quizAttemptModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 id="quizAttemptTitle" class="text-2xl font-bold text-accent-dark">Take Quiz</h2>
                <div class="flex items-center">
                    <span id="quizTimer" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium mr-4">Time: 30:00</span>
                    <button id="closeAttemptModal" class="text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <form id="quizAttemptForm" class="p-6">
                <div id="quizQuestionsContainer">
                    <!-- Quiz questions will be loaded here dynamically -->
                </div>
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-secondary">Submit Quiz</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/quizzes.js') }}"></script>

</body>
</html>
