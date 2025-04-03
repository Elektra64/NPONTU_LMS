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
<<<<<<< HEAD
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Navbar -->
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center">
                <a href="/" class="cursor-pointer">
                    <i class="fas fa-graduation-cap mr-2"></i>EduVerse
                </a>
            </span>
=======
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
        nav, footer {
            background-color: rgba(17, 24, 39, 0.95);
        }
    </style>
</head>
<body class="text-white font-sans">

    <!-- Data Container (Hidden) -->
    <div id="enrollmentData"
         data-course='{{ json_encode($successData['course']) }}'
         data-user='{{ json_encode($successData['user']) }}'
         data-enrollment='{{ json_encode($successData['enrollment']) }}'
         data-has-paid-options='{{ $successData['has_paid_options'] ? 'true' : 'false' }}'
         data-complete-url='{{ route("enroll.complete", $successData["course"]["id"]) }}'>
    </div>

    <!-- Navbar -->
    <nav class="text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
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

                    <a href="{{ route('courses.certificate') }}" class="block px-4 py-2 hover:bg-gray-700">
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
>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
        </div>
    </nav>

    <!-- Enrollment Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto">
<<<<<<< HEAD
            <div class="bg-gray-800 bg-opacity-50 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg overflow-hidden mb-8">
=======
            <div class="content-wrapper rounded-xl shadow-lg overflow-hidden mb-8">
>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
                <div class="p-8">
                    <div class="text-center mb-8">
                        <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                        <h2 class="text-3xl font-bold text-yellow-400 mb-2">Complete Your Enrollment</h2>
                        <p class="text-gray-300">You're almost there! Confirm your details to join the course</p>
                    </div>

                    <!-- Course Info -->
                    <div class="bg-gray-700 bg-opacity-30 rounded-lg p-6 mb-8">
                        <h3 class="text-xl font-semibold mb-2" id="courseTitle">Course Title</h3>
                        <div class="flex items-center text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-white" id="courseRating">4.9</span>
                            <span class="mx-2 text-gray-400">|</span>
                            <i class="fas fa-user-graduate text-gray-300"></i>
                            <span class="ml-1 text-gray-300" id="courseStudents">12,345 students</span>
                        </div>
                        <p class="text-gray-300" id="courseDescription">Course description will appear here</p>
                    </div>

                    <!-- Package Selection (Only shown if course has paid options) -->
                    <div id="packageSelection" class="hidden mb-8">
                        <h3 class="text-xl font-semibold mb-4">Select Your Package</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div id="freePackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer selected">
                                <h4 class="font-bold text-lg mb-2">Free</h4>
                                <p class="text-gray-300 mb-4">Basic course access</p>
<<<<<<< HEAD
                                <div class="text-yellow-400 font-bold text-xl">$0.00</div>
=======
                                <div class="text-yellow-400 font-bold text-xl" id="freePrice">$0.00</div>
>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
                            </div>
                            <div id="standardPackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer">
                                <h4 class="font-bold text-lg mb-2">Standard</h4>
                                <p class="text-gray-300 mb-4">Course + Quizzes</p>
<<<<<<< HEAD
                                <div class="text-yellow-400 font-bold text-xl">$49.99</div>
=======
                                <div class="text-yellow-400 font-bold text-xl" id="standardPrice">$49.99</div>
>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
                            </div>
                            <div id="premiumPackage" class="package-option bg-gray-700 p-6 rounded-lg border-2 border-transparent cursor-pointer">
                                <h4 class="font-bold text-lg mb-2">Premium</h4>
                                <p class="text-gray-300 mb-4">Full access + Certificate</p>
<<<<<<< HEAD
                                <div class="text-yellow-400 font-bold text-xl">$99.99</div>
=======
                                <div class="text-yellow-400 font-bold text-xl" id="premiumPrice">$99.99</div>
>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section (Hidden by default) -->
                    <div id="paymentSection" class="hidden">
                        <!-- Payment Methods -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4">Select Payment Method</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="payment-method bg-gray-700 p-4 rounded-lg border-2 border-transparent cursor-pointer">
                                    <div class="flex items-center">
                                        <i class="fab fa-cc-visa text-3xl text-blue-500 mr-3"></i>
                                        <span class="font-medium">Credit/Debit Card</span>
                                    </div>
                                </div>
                                <div class="payment-method bg-gray-700 p-4 rounded-lg border-2 border-transparent cursor-pointer">
                                    <div class="flex items-center">
                                        <i class="fab fa-paypal text-3xl text-blue-400 mr-3"></i>
                                        <span class="font-medium">PayPal</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <div id="paymentForm" class="bg-gray-700 bg-opacity-30 rounded-lg p-6 mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-300 mb-2">Card Number</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="1234 5678 9012 3456">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">Card Holder</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="John Doe">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">Expiry Date</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="MM/YY">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">CVV</label>
                                    <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="mb-6 text-left">
                        <h3 class="text-xl font-semibold mb-4">Confirm Your Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Full Name</label>
                                <input type="text" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" value="John Doe" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2">Email</label>
                                <input type="email" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400" value="john@example.com" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Submit -->
                    <div class="mb-6">
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="terms" class="mt-1 mr-3" required>
                            <label for="terms" class="text-gray-300 text-sm">
                                I agree to the <a href="#" class="text-yellow-400 hover:underline">Terms of Service</a> and <a href="#" class="text-yellow-400 hover:underline">Privacy Policy</a>.
                            </label>
                        </div>
                        <button id="completeEnrollment" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Complete Enrollment <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<<<<<<< HEAD
=======
    <!-- Enhanced Footer -->
    <footer class="text-white pt-12 pb-6">
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

>>>>>>> 92dc125f3b7ab3c6f68b248f1abcd7cd0a8d280b
    <script src="{{ asset('assets/js/success.js') }}"></script>
</body>
</html>
