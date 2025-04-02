<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Course Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/course.js') }}" defer></script>
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
    <!-- Top Navigation Bar (Fixed padding issue) -->
    <nav class="bg-fine-color shadow-md z-10 w-full px-4 sm:px-6 lg:px-8 ">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo and title -->
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h1 class="text-xl font-bold text-accent-dark">EduVerse</h1>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4">
                        <a href="/"
                            class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('courses') }}"
                            class="flex items-center px-3 py-2 bg-accent-light text-primary rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.09a1 1 0 01.44 1.352l-2.101 4.63A1.518 1.518 0 004.412 16.2l.314-.1a1.036 1.036 0 00.707-.88V9.82a1 1 0 00-.293-.707L3.31 9.09z" />
                            </svg>
                            Courses
                        </a>
                        <a href="{{ route('quizzes') }}"
                            class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Quizzes
                        </a>
                        <a href="{{ route('users') }}"
                            class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17 10c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm-10 0c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3zm10 2c-2.67 0-8 1.336-8 4v2h16v-2c0-2.664-5.33-4-8-4zm-10 0c-.354 0-.689.031-1 .078-2.243.375-4 1.659-4 3.922v2h6v-2c0-.747.213-1.374.547-1.953-.812-.307-1.791-.547-2.547-.547z" />
                            </svg>
                            Users
                        </a>
                        <a href="{{ route('home') }}"
                            class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M14 3v2h4.586L8.293 15.293l1.414 1.414L20 6.414V11h2V3h-8zM4 5v16h16v-6h2v8H2V5h2z" />
                            </svg>
                            View Site
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button and logout -->
                <div class="flex items-center">
                    <a href="{{ route('login') }}"
                        class="flex items-center px-3 py-2 text-red-600 hover:bg-red-100 rounded-md transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L14.586 9H7a1 1 0 110-2h7.586l-1.293-1.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="hidden md:inline">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 m-8 animate-fade-in mt-16">
        <!-- Course Management Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-accent-dark mb-2">Course Management</h1>
                <p class="text-gray-600">Create, edit, and manage your courses</p>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <!-- Search Field -->
                <div class="relative">
                    <input type="text" placeholder="Search courses..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <!-- Add Course Button -->
                <button id="addCourseBtn"
                    class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Course
                </button>
            </div>
        </div>

        <!-- Course Filters -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option>Web Development</option>
                        <option>Data Science</option>
                        <option>Design</option>
                        <option>Business</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option>Published</option>
                        <option>Draft</option>

                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">

                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                    </select>
                </div>
                <button
                    class="mt-6 bg-accent-light hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Courses Table Header -->
            <div
                class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 bg-gray-50 text-sm font-medium text-gray-600">
                <div class="col-span-5">Course Title</div>
                <div class="col-span-2">Category</div>
                <div class="col-span-1">Instructor</div>
                <div class="col-span-1">Status</div>
                <div class="col-span-2">Last Updated</div>
                <div class="col-span-1">Actions</div>
            </div>

            <!-- Course Items -->
            @if ($courses->count())
                @foreach ($courses as $course)
                    <div
                        class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 bg-gray-50 text-sm font-medium text-gray-600">
                        <div class="col-span-5">{{ $course->title }}</div>
                        <div class="col-span-2">{{ $course->categories[0]->category_name }}</div>
                        <div class="col-span-1">{{ $course->user->first_name }}</div>
                        <div class="col-span-1">{{ strtoupper($course->status) }}</div>
                        <div class="col-span-2">{{ $course->updated_at->diffForHumans() }}</div>
                        @can('edit_course', $course)
                            <div class="col-span-1">
                                <button
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md transition-colors flex items-center"
                                    id="addModule">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>

                                </button>
                                <button
                                    class="bg-red-500 text-white px-4 py-2 rounded-md transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg>
                                </button>
                            </div>
                        @endcan
                    </div>
                    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" id="addModuleModal">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[80vh] overflow-y-auto">
                            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                                <h2 class="text-2xl font-bold text-accent-dark">Create Module For Course</h2>
                                <button id="closeModuleModal" class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                
                            <form action="{{ route('store.module', $course->id) }}" method="post" class="p-6 space-y-6">
                                @csrf
                                <div class="border-t border-gray-200 pt-6">
                                    <h3 class="text-lg font-medium text-accent-dark mb-4">Course Modules</h3>
                                    <div id="modules-container" class="space-y-4">
                                        <!-- Modules will be added here dynamically -->
                                    </div>
                                    <button type="button" id="add-module"
                                        class="mt-4 text-sm text-primary hover:text-secondary flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Add Module
                                    </button>
                                    <button class="mt-4 text-sm text-primary hover:text-secondary flex items-center" type="submit">Submit</button>
                                </div>
                
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Pagination -->
            <div class="flex justify-between items-center p-4 border-t border-gray-200">
                {{ $courses->links() }}
            </div>
        </div>
    </main>

    <!-- Enhanced Course Creation Modal -->
    <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-accent-dark">Create New Course</h2>
                <button id="closeModal" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="courseCreationForm" class="p-6 space-y-6" method="POST"
                action="{{ route('create_course') }}">
                @csrf
                <!-- Basic Course Information -->
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input type="text" name="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                            <option value="">Select Category</option>
                            <option value="Web Development">Web Development</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Design">Design</option>
                            <option value="Business">Business</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Difficulty Level</label>
                        <select name="difficulty"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                            <option value="" selected disabled>Select Difficulty</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                </div>

                <!-- Course Duration -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Duration (weeks)*</label>
                        <input type="number" name="duration_weeks" min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Credit Hours Per Week</label>
                        <input type="number" name="credit_hours" min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                    </div>
                </div>

                <!-- Course Overview Video -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Overview Video URL*</label>
                        <input type="url" name="video_url"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                            placeholder="https://example.com/video">
                        <p class="mt-1 text-sm text-gray-500">Embed URL from YouTube, Vimeo, or your hosting platform
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Number of modules for the course</label>
                        <input type="number" name="number_of_modules" min="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                    </div>
                </div>

                <!-- Course Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Description*</label>
                    <textarea name="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"></textarea>
                </div>

                <!-- Final Exam Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-accent-dark mb-4">Final Exam Settings</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Exam Weight (% of total
                                grade)*</label>
                            <input type="number" name="final_exam_weight" min="0" max="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                value="30">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" id="cancelCourse"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md hover:bg-secondary">Create Course</button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" id="addModuleModal">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-accent-dark">Create Module For Course</h2>
                <button id="closeModuleModal" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('store.module', $course) }}" method="get" class="p-6 space-y-6">
                
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-accent-dark mb-4">Course Modules</h3>
                    <div id="modules-container" class="space-y-4">
                        <!-- Modules will be added here dynamically -->
                    </div>
                    <button type="button" id="add-module"
                        class="mt-4 text-sm text-primary hover:text-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Module
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Module Template (Hidden) -->
    <template id="module-template">
        <div class="module-item p-4 border border-gray-200 rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-medium text-gray-800">Module</h4>
                <button type="button"
                    class="remove-module text-red-600 hover:text-red-800 text-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Remove
                </button>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Module Title*</label>
                    <input type="text" name="module_title[]"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Module Number</label>
                    <input type="number" name="module_number[]" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Module Content</label>
                <textarea name="module_content[]" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"></textarea>
            </div>

            {{-- <!-- Module Quiz Section -->
            <div class="module-quiz bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-md font-medium text-gray-700">Module Quiz</h5>
                </div>

                <div class="quiz-questions space-y-4">
                    <!-- Questions will be added here -->
                </div>

                <button type="button"
                    class="add-question mt-4 text-sm text-primary hover:text-secondary flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Question
                </button>
            </div> --}}
        </div>
    </template>

    <!-- Question Template (Hidden) -->
    <template id="question-template">
        <div class="question-item p-4 border border-gray-200 rounded-lg bg-white">
            <div class="flex justify-between items-center mb-3">
                <h6 class="text-sm font-medium text-gray-700">Question <span class="question-number">1</span></h6>
                <button type="button"
                    class="remove-question text-red-600 hover:text-red-800 text-xs flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Remove
                </button>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Question Text*</label>
                <input type="text" name="module_question[]"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option A*</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="mcq_option_a[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="radio" name="mcq_choice[]" value="a"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option B*</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="mcq_option_b[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="radio" name="mcq_choice[]" value="b"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option C</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="mcq_option_c[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="radio" name="mcq_choice[]" value="c"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Option D</label>
                    <div class="flex items-center mt-1">
                        <input type="text" name="mcq_option_d[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <input type="radio" name="mcq_choice[]" value="d"
                            class="ml-2 h-4 w-4 text-primary focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>
    </template>
</body>

</html>
