<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Web Development | EduVerse University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dynamic-bg {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 50%, #1e293b 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .user-badge {
            transition: all 0.3s ease;
        }

        .user-badge:hover {
            transform: scale(1.05);
        }

        .module-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .module-open .module-content {
            max-height: 1000px;
            /* Adjust based on your content */
        }

        .progress-bar {
            height: 8px;
            transition: width 0.5s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar (same as homepage) -->
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center">
                <i class="fas fa-graduation-cap mr-2"></i>EduVerse
            </span>
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('published.courses') }}"
                    class="hover:text-yellow-400 transition duration-300 flex items-center">
                    <i class="fas fa-book mr-2"></i>Courses
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>Calendar
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center">
                    <i class="fas fa-comments mr-2"></i>Discussions
                </a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="hidden md:block relative">
                <input type="text" placeholder="Search courses..."
                    class="bg-gray-700 text-white px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400 w-64">
                <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
            </div>
            <div
                class="user-badge flex items-center space-x-3 bg-gray-800 px-3 py-1 rounded-full cursor-pointer hover:bg-gray-700">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-medium">Sarah Johnson</div>
                    <div class="text-xs text-gray-400">Student</div>
                </div>
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User profile"
                        class="w-8 h-8 rounded-full border-2 border-yellow-400">
                    <span
                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-xs hidden md:block"></i>
            </div>
        </div>
    </nav>

    <!-- Course Header Section -->
    <header class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <nav class="flex text-sm text-gray-300 mb-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}" class="inline-flex items-center hover:text-yellow-400">
                                    <i class="fas fa-home mr-1"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-500 mx-1 text-xs"></i>
                                    <a href="#" class="ml-1 hover:text-yellow-400">My Courses</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-500 mx-1 text-xs"></i>
                                    <span class="ml-1 text-yellow-400">Advanced Web Development</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl font-bold">Advanced Web Development</h1>
                    <p class="text-gray-300 mt-1">Master modern web technologies and frameworks</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-6 py-2 rounded-full transition duration-300 flex items-center">
                        <i class="fas fa-share-alt mr-2"></i> Share
                    </button>
                    <button
                        class="bg-gray-700 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded-full transition duration-300 flex items-center">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Course Progress Section -->
    <section class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="w-full md:w-3/4 mb-4 md:mb-0">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium">Course Progress: 35%</span>
                        <span class="text-sm text-gray-300">7/20 lessons completed</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2.5">
                        <div class="progress-bar bg-yellow-400 rounded-full" style="width: 35%"></div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button
                        class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm flex items-center">
                        <i class="fas fa-bookmark mr-2"></i> Save Progress
                    </button>
                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-full text-sm font-bold flex items-center">
                        <i class="fas fa-certificate mr-2"></i> Certificate
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Course Content -->
    <div class="container mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        <!-- Course Modules Sidebar -->
        <aside class="w-full lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-900 text-white p-4">
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="fas fa-list-ol mr-2"></i> Course Modules
                    </h2>
                </div>
                <div class="p-4">
                    <!-- Module 1 -->
                    <div class="mb-4 border border-gray-200 rounded-lg overflow-hidden">
                        <div
                            class="module-toggle bg-gray-100 p-3 flex justify-between items-center cursor-pointer hover:bg-gray-200 transition duration-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold mr-3">
                                    1</div>
                                <h3 class="font-semibold">HTML5 & CSS3 Fundamentals</h3>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                        <div class="module-content bg-white">
                            <ul class="divide-y divide-gray-200">
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-play-circle text-yellow-500 mr-3"></i>
                                    <span>Introduction to HTML5</span>
                                    <span class="ml-auto text-sm text-gray-500">12:45</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <span class="text-gray-600">CSS3 Basics</span>
                                    <span class="ml-auto text-sm text-gray-500">15:30</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <span class="text-gray-600">Responsive Design</span>
                                    <span class="ml-auto text-sm text-gray-500">18:20</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-file-alt text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Assignment: Portfolio Page</span>
                                    <span class="ml-auto text-sm text-gray-500">Due: 2 days</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 2 -->
                    <div class="mb-4 border border-gray-200 rounded-lg overflow-hidden">
                        <div
                            class="module-toggle bg-gray-100 p-3 flex justify-between items-center cursor-pointer hover:bg-gray-200 transition duration-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold mr-3">
                                    2</div>
                                <h3 class="font-semibold">JavaScript Essentials</h3>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                        <div class="module-content bg-white">
                            <ul class="divide-y divide-gray-200">
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <span class="text-gray-600">JavaScript Basics</span>
                                    <span class="ml-auto text-sm text-gray-500">22:15</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <span class="text-gray-600">DOM Manipulation</span>
                                    <span class="ml-auto text-sm text-gray-500">25:40</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-play-circle text-yellow-500 mr-3"></i>
                                    <span>ES6 Features</span>
                                    <span class="ml-auto text-sm text-gray-500">19:10</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-file-alt text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Assignment: Interactive Quiz</span>
                                    <span class="ml-auto text-sm text-gray-500">Due: 5 days</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 3 -->
                    <div class="mb-4 border border-gray-200 rounded-lg overflow-hidden">
                        <div
                            class="module-toggle bg-gray-100 p-3 flex justify-between items-center cursor-pointer hover:bg-gray-200 transition duration-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-black font-bold mr-3">
                                    3</div>
                                <h3 class="font-semibold text-gray-600">React Framework</h3>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                        <div class="module-content bg-white">
                            <ul class="divide-y divide-gray-200">
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">Introduction to React</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">Components & Props</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">State Management</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Module 4 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div
                            class="module-toggle bg-gray-100 p-3 flex justify-between items-center cursor-pointer hover:bg-gray-200 transition duration-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-black font-bold mr-3">
                                    4</div>
                                <h3 class="font-semibold text-gray-600">Backend Integration</h3>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                        <div class="module-content bg-white">
                            <ul class="divide-y divide-gray-200">
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">RESTful APIs</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">Authentication</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                                <li class="p-3 hover:bg-gray-50 cursor-pointer flex items-center">
                                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                                    <span class="text-gray-400">Final Project</span>
                                    <span class="ml-auto text-sm text-gray-400">Locked</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Card -->
            <div class="bg-white rounded-lg shadow-md mt-6 overflow-hidden">
                <div class="bg-gray-900 text-white p-4">
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="fas fa-book mr-2"></i> Resources
                    </h2>
                </div>
                <div class="p-4">
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 mr-3"></i>
                            <a href="#" class="text-blue-600 hover:underline">Course Syllabus</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-link text-blue-500 mr-3"></i>
                            <a href="#" class="text-blue-600 hover:underline">Useful Web Development Links</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-code text-yellow-500 mr-3"></i>
                            <a href="#" class="text-blue-600 hover:underline">Starter Code Files</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-video text-purple-500 mr-3"></i>
                            <a href="#" class="text-blue-600 hover:underline">Bonus Video Lectures</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Main Course Content Area -->
        <main class="w-full lg:w-3/4">
            <!-- Current Lesson -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="bg-gray-900 text-white p-4">
                    <h2 class="text-xl font-bold">Current Lesson: ES6 Features</h2>
                    <p class="text-gray-300 text-sm">Module 2: JavaScript Essentials</p>
                </div>
                <div class="p-6">
                    <!-- Video Player -->
                    <div class="bg-black aspect-video mb-6 flex items-center justify-center">
                        <div class="text-white text-center">
                            <i class="fas fa-play-circle text-5xl mb-2"></i>
                            <p>Video Player</p>
                        </div>
                    </div>

                    <!-- Lesson Navigation -->
                    <div class="flex justify-between items-center mb-6">
                        <button
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Previous Lesson
                        </button>
                        <div class="text-sm text-gray-600">Lesson 3 of 4 in this module</div>
                        <button
                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-4 py-2 rounded flex items-center">
                            Next Lesson <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>

                    <!-- Lesson Content -->
                    <div class="prose max-w-none">
                        <h3 class="text-2xl font-bold mb-4">ES6 Features Overview</h3>
                        <p class="mb-4">ECMAScript 2015 (ES6) introduced many new features that have become
                            fundamental to modern JavaScript development. In this lesson, we'll cover the most important
                            ones you should know.</p>

                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <h4 class="font-bold text-lg mb-2 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Learning Objectives
                            </h4>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Understand and use let and const for variable declarations</li>
                                <li>Work with arrow functions and their lexical this</li>
                                <li>Utilize template literals for string interpolation</li>
                                <li>Implement destructuring for objects and arrays</li>
                                <li>Use spread and rest operators effectively</li>
                            </ul>
                        </div>

                        <h4 class="font-bold text-xl mt-6 mb-3">1. let and const</h4>
                        <p class="mb-4">ES6 introduced two new ways to declare variables:</p>
                        <pre class="bg-gray-800 text-gray-100 p-4 rounded-lg mb-4 overflow-x-auto">
<code>// Block-scoped variables
let count = 10;
if (true) {
    let count = 20; // Different variable
    console.log(count); // 20
}
console.log(count); // 10

// Constants
const PI = 3.14159;
// PI = 3.14; // Error: Assignment to constant variable</code></pre>

                        <h4 class="font-bold text-xl mt-6 mb-3">2. Arrow Functions</h4>
                        <p class="mb-4">Arrow functions provide a concise syntax and lexical this binding:</p>
                        <pre class="bg-gray-800 text-gray-100 p-4 rounded-lg mb-4 overflow-x-auto">
<code>// Traditional function
function add(a, b) {
    return a + b;
}

// Arrow function equivalent
const add = (a, b) => a + b;

// Lexical this
function Timer() {
    this.seconds = 0;
    setInterval(() => {
        this.seconds++; // 'this' refers to Timer instance
    }, 1000);
}</code></pre>

                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-bold text-blue-800">PRO TIP</h4>
                                    <div class="mt-1 text-sm text-blue-700">
                                        <p>While arrow functions are great for concise code, they can't be used as
                                            constructors and don't have their own arguments object.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-bold text-xl mt-6 mb-3">Practice Exercise</h4>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg mb-4">
                            <p class="mb-3">Convert the following code to use ES6 features:</p>
                            <pre class="bg-gray-800 text-gray-100 p-4 rounded-lg mb-3 overflow-x-auto">
<code>var numbers = [1, 2, 3, 4, 5];
var doubled = numbers.map(function(n) {
    return n * 2;
});
console.log("Doubled numbers: " + doubled);</code></pre>
                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-4 py-2 rounded flex items-center">
                                <i class="fas fa-lightbulb mr-2"></i> Show Solution
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lesson Completion -->
                <div class="bg-gray-50 p-4 border-t border-gray-200 flex justify-between items-center">
                    <div class="flex items-center">
                        <input type="checkbox" id="complete-lesson"
                            class="h-5 w-5 text-yellow-500 rounded border-gray-300 focus:ring-yellow-500">
                        <label for="complete-lesson" class="ml-2 text-gray-700">Mark as complete</label>
                    </div>
                    <div class="flex space-x-3">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-flag"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bookmark"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Discussion Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-900 text-white p-4">
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="fas fa-comments mr-2"></i> Lesson Discussion
                    </h2>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <textarea
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                            rows="3" placeholder="Have a question or comment about this lesson?"></textarea>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-paperclip mr-1"></i> Attach files
                            </div>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-4 py-2 rounded">
                                Post Comment
                            </button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        <div class="flex space-x-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User"
                                class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold">Michael Chen</span>
                                        <span class="text-sm text-gray-500">2 hours ago</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">Can someone explain why arrow functions don't have
                                        their own 'this' context? I'm still a bit confused about when to use them vs
                                        regular functions.</p>
                                    <div class="flex space-x-4 text-sm text-gray-500">
                                        <button class="hover:text-yellow-500"><i class="fas fa-thumbs-up mr-1"></i>
                                            Like (5)</button>
                                        <button class="hover:text-yellow-500"><i class="fas fa-reply mr-1"></i>
                                            Reply</button>
                                    </div>
                                </div>

                                <!-- Reply -->
                                <div class="flex space-x-4 mt-4 ml-10">
                                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="User"
                                        class="w-8 h-8 rounded-full">
                                    <div class="flex-1">
                                        <div class="bg-gray-100 p-3 rounded-lg">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="font-bold text-sm">Sarah Johnson (Instructor)</span>
                                                <span class="text-xs text-gray-500">1 hour ago</span>
                                            </div>
                                            <p class="text-gray-700 text-sm mb-1">Great question! Arrow functions
                                                inherit 'this' from their surrounding (lexical) context. This makes them
                                                ideal for callbacks where you want to preserve the 'this' from the outer
                                                scope. Regular functions have their own 'this', which is useful when you
                                                need dynamic context (like in methods).</p>
                                            <div class="flex space-x-3 text-xs text-gray-500">
                                                <button class="hover:text-yellow-500"><i
                                                        class="fas fa-thumbs-up mr-1"></i> Like (8)</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comment 2 -->
                        <div class="flex space-x-4">
                            <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="User"
                                class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold">Jessica Park</span>
                                        <span class="text-sm text-gray-500">45 minutes ago</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">The template literals example was really helpful! I
                                        didn't realize you could do multi-line strings so easily without concatenation.
                                    </p>
                                    <div class="flex space-x-4 text-sm text-gray-500">
                                        <button class="hover:text-yellow-500"><i class="fas fa-thumbs-up mr-1"></i>
                                            Like (3)</button>
                                        <button class="hover:text-yellow-500"><i class="fas fa-reply mr-1"></i>
                                            Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer (same as homepage) -->
    <footer class="bg-gray-800 text-white pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> EduVerse
                    </h3>
                    <p class="text-gray-400 mb-4">Empowering learners worldwide with accessible, high-quality education
                        since 2015.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Home</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">About Us</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Instructors</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Help
                                Center</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">FAQs</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new courses and offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="bg-gray-700 text-white px-4 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-r transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 EduVerse University. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#"
                        class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Privacy Policy</a>
                    <a href="#"
                        class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Terms of
                        Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle module content
        document.querySelectorAll('.module-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const module = toggle.closest('div');
                module.classList.toggle('module-open');
                const icon = toggle.querySelector('i');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });

        // Mark lesson as complete
        document.getElementById('complete-lesson').addEventListener('change', function() {
            if (this.checked) {
                // Update progress bar
                const progressBar = document.querySelector('.progress-bar');
                const currentWidth = parseFloat(progressBar.style.width || '35');
                progressBar.style.width = (currentWidth + 5) + '%';

                // You would typically send an AJAX request to update progress on the server
                console.log('Lesson marked as complete');
            }
        });
    </script>
</body>

</html>
