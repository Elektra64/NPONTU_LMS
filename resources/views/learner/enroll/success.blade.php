<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Enrollment | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .payment-method.selected {
            border-color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.1);
        }

        .package-option {
            transition: all 0.3s ease;
        }

        .package-option.selected {
            border-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.5);
        }

        body {
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTh8fHRlY2glMjBsZWFybmluZ3xlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
            opacity: 0.3;
        }

        .content-wrapper {
            background-color: rgba(17, 24, 39, 0.9);
        }

        nav,
        footer {
            background-color: rgba(17, 24, 39, 0.95);
        }
    </style>
</head>

<body class="text-white font-sans">


    <!-- Navbar -->
    <nav class="text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center">
                <a href="{{ route('home') }}" class="cursor-pointer">
                    <i class="fas fa-graduation-cap mr-2"></i>EduVerse
                </a>
            </span>
            <div class="hidden md:flex space-x-6">
                <!-- Unified Courses Entry -->
                <a href="{{ route('published.courses') }}"
                    class="hover:text-yellow-400 transition duration-300 flex items-center">
                    <i class="fas fa-book-open mr-2"></i>Courses
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
                <div
                    class="absolute hidden group-hover:block bg-gray-800 mt-2 py-2 w-48 rounded shadow-lg z-50 right-0">
                    <a href="{{ route('published.courses') }}" class="block px-4 py-2 hover:bg-gray-700">
                        <i class="fas fa-search mr-2"></i> Browse Catalog
                    </a>

                    <a href="#" class="block px-4 py-2 hover:bg-gray-700">
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
            <div
                class="user-badge flex items-center space-x-3 bg-gray-800 px-3 py-1 rounded-full cursor-pointer hover:bg-gray-700">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-medium">John Doe</div>
                    <div class="text-xs text-gray-400">Learner</div>
                </div>
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile"
                        class="w-8 h-8 rounded-full border-2 border-yellow-400">
                </div>
            </div>
        </div>
    </nav>

    <!-- Enrollment Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto">
            <div
                class="bg-gray-800 bg-opacity-50 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg overflow-hidden mb-8">

                <div class="content-wrapper rounded-xl shadow-lg overflow-hidden mb-8">

                    <div class="p-8">
                        <div class="text-center mb-8">
                            <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                            <h2 class="text-3xl font-bold text-yellow-400 mb-2">Complete Your Enrollment</h2>
                            <p class="text-gray-300">You're almost there! Confirm your details to join the course</p>
                        </div>

                        <!-- Course Info -->
                        <div class="bg-gray-700 bg-opacity-30 rounded-lg p-6 mb-8">
                            <h3 class="text-xl font-semibold mb-2" id="courseTitle">{{ $course->title }}</h3>
                            <div class="flex items-center text-yellow-400 mb-2">
                                <i class="fas fa-star"></i>
                                <span class="ml-1 text-white" id="courseRating">4.9</span>
                                <span class="mx-2 text-gray-400">|</span>
                                <i class="fas fa-user-graduate text-gray-300"></i>
                                <span class="ml-1 text-gray-300" id="courseStudents">12,345 students</span>
                            </div>
                            <p class="text-gray-300" id="courseDescription">{{ $course->description }}</p>
                        </div>
                    </div>
                </div>
                <!-- Terms and Submit -->
                <div class="mb-6 opacity-100">
                    <form action="{{ route('enroll', $course->id) }}" class="" method="post">
                        @csrf
                        <div class="flex items-start mb-4 justify-center">
                            <input type="checkbox" id="terms" class="mt-1 mr-3" name="terms">
                            <label for="terms" class="text-gray-300 text-sm">
                                I agree to the <a href="#" class="text-yellow-400 hover:underline">Terms of Service</a>
                                and
                                <a href="#" class="text-yellow-400 hover:underline">Privacy Policy</a>.
                            </label>
                        </div>
                        <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
       
    </section>

    <!-- Enhanced Footer -->
    <footer class="text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Column 1 -->
                <div>
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i> EduVerse
                    </h3>
                    <p class="text-gray-400 mb-4">Empowering learners worldwide with accessible, high-quality
                        education since 2015.</p>
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
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Home</a></li>
                        <li><a href="{{ route('published.courses') }}"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Courses</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">About Us</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Instructors</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Pricing</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Blog</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition duration-300">Help
                                Center</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">FAQs</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Terms of
                                Service</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Privacy
                                Policy</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Cookie
                                Policy</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition duration-300">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new courses, discounts and special
                        offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="bg-gray-700 text-white px-4 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-yellow-400 w-full">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-r transition duration-300">
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
                    <a href="#"
                        class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Privacy
                        Policy</a>
                    <a href="#"
                        class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Terms of
                        Service</a>
                    <a href="#"
                        class="text-gray-400 hover:text-yellow-400 text-sm transition duration-300">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset('assets/js/success.js') }}"></script>
</body>

</html>
