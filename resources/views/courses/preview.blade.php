<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $course['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <!-- Unified Courses Entry -->
            <a href="{{ route('courses.publishedCourse') }}" class="hover:text-yellow-400 transition duration-300 flex items-center">
                <i class="fas fa-book-open mr-2"></i>Courses
            </a>

            <!-- Learning Tools -->
            <a href="{{ route('quizzes') }}" class="hover:text-yellow-400 transition duration-300 flex items-center">
                <i class="fas fa-tasks mr-2"></i>Learning
            </a>


        </div>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Quick Access Dropdown -->
        <div class="relative group">
            <button class="hover:text-yellow-400 px-3 py-1 rounded-lg transition duration-300 flex items-center">
                <i class="fas fa-bolt mr-2"></i> Quick Access
                <i class="fas fa-chevron-down ml-1 text-xs"></i>
            </button>
            <div class="absolute hidden group-hover:block bg-gray-800 mt-2 py-2 w-48 rounded shadow-lg z-50 right-0">
                <a href="{{ route('courses.publishedCourse') }}" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-search mr-2"></i> Browse Catalog
                </a>

                <a href="{{ route('certificateTemplate') }}" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-certificate mr-2"></i> Certificates
                </a>
            </div>
        </div>


    </div>
    <div class="flex items-center space-x-4">
        <!-- Notification Bell -->
        <a href="#" class="p-2 rounded-full hover:bg-gray-700 relative">
            <i class="fas fa-bell"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-yellow-400"></span>
        </a>

        <!-- User Menu -->
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

    <!-- Preview Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Course Header -->
            <div class="relative">
                <img src="{{ $course['image'] }}" alt="{{ $course['title'] }}" class="w-full h-64 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                    <h1 class="text-3xl font-bold text-white">{{ $course['title'] }}</h1>
                    <p class="text-gray-200">{{ $course['description'] }}</p>
                </div>
                <span class="difficulty-{{ $course['difficulty'] }} text-xs font-bold px-2 py-1 rounded absolute top-2 left-2">
                    {{ ucfirst($course['difficulty']) }}
                </span>
            </div>

            <!-- Course Details -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold mb-4">About This Course</h2>
                    <div class="prose max-w-none">
                        <p>This preview gives you an overview of what you'll learn in this course.</p>

                        <h3 class="text-xl font-semibold mt-6 mb-3">What You'll Learn</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach($content['sections'] as $section)
                                <li>{{ $section['title'] }}</li>
                            @endforeach
                        </ul>

                        <!-- <h3 class="text-xl font-semibold mt-6 mb-3">Course Content</h3> -->
                        <!-- <div class="border rounded-lg overflow-hidden">
                            @foreach($content['sections'] as $index => $section)
                                <div class="border-b last:border-b-0">
                                    <div class="p-4 bg-gray-50 font-medium">
                                        <i class="fas fa-folder-open mr-2 text-yellow-500"></i>
                                        Section {{ $index + 1 }}: {{ $section['title'] }}
                                    </div>
                                    <div class="divide-y">
                                        @foreach($section['lessons'] as $lessonIndex => $lesson)
                                            <div class="p-4 flex items-center">
                                                <i class="fas fa-play-circle mr-3 text-gray-400"></i>
                                                <span>Lesson {{ $lessonIndex + 1 }}: {{ $lesson['title'] }}</span>
                                                <span class="ml-auto text-sm text-gray-500">{{ $lesson['duration'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div> -->
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold text-lg mb-3">Course Details</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-chalkboard-teacher mr-2 text-gray-600"></i>
                                <span>Instructor: {{ $course['instructor'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2 text-gray-600"></i>
                                <span>Students: {{ number_format($course['students_count']) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star mr-2 text-gray-600"></i>
                                <span>Rating: {{ $course['rating'] }}/5.0</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2 text-gray-600"></i>
                                <span>Category: {{ $course['category'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Card -->
                    <div class="border rounded-lg shadow-sm p-4">
                        <div class="text-center mb-4">
                            @if($course['is_free'])
                                <span class="text-3xl font-bold">Free</span>
                            @else
                                <span class="text-3xl font-bold">${{ number_format($course['price'], 2) }}</span>
                                @if($course['standard_price'] > $course['price'])
                                    <span class="line-through text-gray-500 ml-2">${{ number_format($course['standard_price'], 2) }}</span>
                                @endif
                            @endif
                        </div>

                        <a href="/enroll/{{ $course['id'] }}/verify" class="block w-full bg-yellow-500 hover:bg-yellow-600 text-center text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            Enroll Now
                        </a>

                        @if($course['has_paid_options'])
                            <p class="text-sm text-gray-600 mt-2 text-center">
                                Premium options available after enrollment
                            </p>
                        @endif

                        <div class="mt-4 text-sm">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Full lifetime access</span>
                            </div>
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Certificate of completion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <!-- Enhanced Footer -->
       <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Column 1 -->
                <div>
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> EduVerse
                    </h3>
                    <p class="text-gray-400 mb-4">Empowering learners worldwide with accessible, high-quality education since 2015.</p>
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

                <!-- Column 2 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Home</a></li>
                        <li><a href="{{ route('courses.publishedCourse') }}" class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Instructors</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Blog</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new courses, discounts and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="bg-gray-700 text-white px-4 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-r transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <div class="mt-4 flex items-center text-gray-400">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="mt-2 flex items-center text-gray-400">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>support@eduverse.com</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 EduVerse University. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
