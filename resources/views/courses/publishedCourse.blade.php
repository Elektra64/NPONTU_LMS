<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Course Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .course-card {
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .difficulty-beginner {
            background-color: #10b981;
            color: white;
        }
        .difficulty-intermediate {
            background-color: #f59e0b;
            color: white;
        }
        .difficulty-advanced {
            background-color: #ef4444;
            color: white;
        }
        .course-card-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Enhanced Navbar -->
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center">
               <a href="/home" class="cursor-pointer">
               <i class="fas fa-graduation-cap mr-2"></i>EduVerse
               </a>
            </span>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-yellow-400 hover:text-yellow-300 transition duration-300 flex items-center">
                    <i class="fas fa-book mr-2"></i>Courses
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <!-- User Badge -->
            <div class="user-badge flex items-center space-x-3 bg-gray-800 px-3 py-1 rounded-full cursor-pointer hover:bg-gray-700">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-medium">John Doe</div>
                    <div class="text-xs text-gray-400">Learner</div>
                </div>
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile" class="w-8 h-8 rounded-full border-2 border-yellow-400">
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Course Catalog</h1>
            <p class="text-gray-600">Browse our comprehensive collection of courses to start your learning journey</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search courses..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                        id="searchInput"
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Category Filter -->
                <div>
                    <select
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                        id="categoryFilter"
                    >
                        <option value="">All Categories</option>
                        <option value="web">Web Development</option>
                        <option value="data">Data Science</option>
                        <option value="business">Business</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                    </select>
                </div>

                <!-- Difficulty Filter -->
                <div>
                    <select
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                        id="difficultyFilter"
                    >
                        <option value="">All Difficulty Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Course Grid - Will be populated by JavaScript -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="courseGrid">
            <!-- Courses will be dynamically inserted here -->
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="inline-flex rounded-md shadow">
                <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">1</a>
                <a href="#" class="px-3 py-2 border border-gray-300 bg-yellow-500 text-black font-medium">2</a>
                <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">3</a>
                <a href="#" class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> EduVerse
                    </h3>
                    <p class="text-gray-400 mb-4">Empowering learners worldwide with accessible, high-quality education.</p>
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
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Terms</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Privacy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <p class="text-gray-400 mb-2"><i class="fas fa-envelope mr-2"></i> support@eduverse.com</p>
                    <p class="text-gray-400 mb-2"><i class="fas fa-phone-alt mr-2"></i> +1 (555) 123-4567</p>
                    <p class="text-gray-400"><i class="fas fa-map-marker-alt mr-2"></i> 123 Education St, Learning City</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                © 2023 EduVerse University. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Link to external JavaScript file -->
    <script src="{{ asset('assets/js/publishedCourse.js') }}"></script>
</body>
</html>
