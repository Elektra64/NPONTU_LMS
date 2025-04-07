<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Course Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                            class="flex items-center px-3 py-2 text-gray-700 hover:bg-accent-light  rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.09a1 1 0 01.44 1.352l-2.101 4.63A1.518 1.518 0 004.412 16.2l.314-.1a1.036 1.036 0 00.707-.88V9.82a1 1 0 00-.293-.707L3.31 9.09z" />
                            </svg>
                            Courses
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
                    <a href="{{ route('logout') }}"
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
                        <option>All Categories</option>
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
                        <option>All Statuses</option>
                        <option>Published</option>
                        <option>Draft</option>
                        <option>Archived</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                    <select
                        class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option>All Levels</option>
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
                <div class="col-span-1">Students</div>
                <div class="col-span-1">Status</div>
                <div class="col-span-2">Last Updated</div>
                <div class="col-span-1">Actions</div>
            </div>

            <!-- Course Items -->
            <div>
                @if ($courses->count())
                    @foreach ($courses as $course)
                        <div
                            class="grid grid-cols-12 gap-4 p-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="col-span-5 flex items-center">
                                <div
                                    class="w-16 h-12 rounded-md flex items-center justify-center mr-4 {{ $course->setColor($course->categories[0]->category_name, 'bg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 {{ $course->setColor($course->categories[0]->category_name, 'text') }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $course->difficulty }}</p>
                                </div>
                            </div>
                            <div class="col-span-2 flex items-center">
                                <span
                                    class="{{ $course->setColor($course->categories[0]->category_name, 'badge') }} px-2 py-1 rounded-full text-xs">{{ $course->categories[0]->category_name }}
                                </span>
                            </div>
                            <div class="col-span-1 flex items-center text-gray-700">{{ $course->enrollments->count() }}</div>
                            <div class="col-span-1 flex items-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $course->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ strtoupper($course->status) }}</span>
                            </div>
                            <div class="col-span-2 flex items-center text-sm text-gray-600">
                                {{ $course->updated_at->diffForHumans() }}</div>
                            <div class="col-span-1 flex items-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800" onclick="openModal(true)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800" onclick="deleteCourse(this)"
                                    data-url='{{ route('delete_course', $course->id) }}'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <x-module-component :course="$course" :modules="$course->modules"> </x-module-component>
                    @endforeach

                @endif

            </div>

            <!-- Pagination -->
            <div class=" p-4 border-t border-gray-200">
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
            <form id="courseCreationForm" class="p-6 space-y-6" action="{{ route('create_course') }}"
                method="post">
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
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                            x <option value="">Select Category</option>
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
                        <label class="block text-sm font-medium text-gray-700">Credit Hours Per Week*</label>
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
                        <label class="block text-sm font-medium text-gray-700">Number Of Modules For Course*</label>
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

                <!-- Modules Section -->
                {{-- <div class="border-t border-gray-200 pt-6">
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
                </div> --}}

                <!-- Final Exam Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-accent-dark mb-4">Final Exam Settings</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Exam Weight (% of total
                                grade)*</label>
                            <input type="number" name="final_exam_weight" min="0" max="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50"
                                value="70">
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


    <script src="{{ asset('assets/js/course.js') }}"></script>


</body>

</html>
