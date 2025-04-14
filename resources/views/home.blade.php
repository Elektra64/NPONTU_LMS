<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse University - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dynamic-bg {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 50%, #1e293b 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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
        .nav-link.active {
    @apply text-yellow-400 border-b-2 border-yellow-400;
}
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Enhanced Navbar -->
    <x-navbar />

    <!-- Hero Section -->
    <header class="relative text-white text-center py-20">
        <div class="absolute inset-0 w-full h-full bg-black opacity-60 z-0"></div>
        <img alt="Students learning together" class="absolute inset-0 w-full h-full object-cover z-0" height="600" src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTh8fHRlY2glMjBsZWFybmluZ3xlbnwwfHwwfHx8MA%3D%3D" width="1920"/>
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-5xl font-bold mb-6">Welcome to EduVerse Learning Platform</h1>
            <p class="mt-4 text-xl max-w-3xl mx-auto">Transform your future with our cutting-edge online education platform. Learn from industry experts and earn recognized certifications.</p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-8 py-3 rounded-full transition duration-300 transform hover:scale-105">
                    <a href="{{ route('courses.publishedCourse') }}" class="flex items-center justify-center">
                        <i class="fas fa-book-open mr-2"></i> Explore Courses
                    </a>
                </button>
                <button class="bg-transparent hover:bg-white hover:text-gray-900 text-white font-bold px-8 py-3 rounded-full border-2 border-white transition duration-300 transform hover:scale-105">
                    <a href="#" class="flex items-center justify-center">
                        <i class="fas fa-play-circle mr-2"></i> Watch Demo
                    </a>
                </button>
            </div>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">10K+</div>
                    <div class="text-gray-300">Active Students</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">500+</div>
                    <div class="text-gray-300">Online Courses</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">200+</div>
                    <div class="text-gray-300">Expert Instructors</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">95%</div>
                    <div class="text-gray-300">Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose EduVerse Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose EduVerse?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We provide the best online learning experience with innovative technologies and comprehensive support</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-yellow-400">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-clock text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Flexible Learning</h3>
                    <p class="text-gray-600">Study at your own pace with our flexible online learning platform. Access course materials 24/7 from anywhere in the world with our mobile-friendly interface.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-yellow-400">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-chalkboard-teacher text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry professionals and academic experts who bring real-world experience to your education through interactive video lectures and live Q&A sessions.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 border-l-4 border-yellow-400">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-certificate text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Recognized Certificates</h3>
                    <p class="text-gray-600">Earn globally recognized certificates upon completion of your courses and boost your career prospects with our career services and job placement assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Courses Section with Dynamic Background -->
    <section class="py-16 dynamic-bg text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Popular Courses</h2>
                <p class="text-gray-300 max-w-2xl mx-auto">Browse our most popular courses loved by thousands of students worldwide</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- In your home.blade.php, find the popular courses section and update the button -->
            @foreach($popularCourses as $course)
            <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-lg course-card transition duration-300">
                <div class="relative">
                    <img src="{{ $course['image'] }}" alt="{{ $course['title'] }}" class="w-full h-48 object-cover">
                    @if(isset($course['badge']))
                    <div class="absolute top-2 right-2 {{ $course['badgeColor'] }} text-xs font-bold px-2 py-1 rounded">{{ $course['badge'] }}</div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-yellow-400 text-sm font-semibold">{{ $course['category'] }}</span>
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-white">{{ $course['rating'] }}</span>            </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">{{ $course['title'] }}</h3>
                    <p class="text-gray-300 text-sm mb-4">{{ $course['description'] }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-user-graduate mr-1"></i>
                            <span>{{ number_format($course['students_count']) }} students</span>
                        </div>
                        <a href="/courses/{{ $course['id'] }}/preview" class="text-yellow-400 hover:text-yellow-300 text-sm font-semibold">
                            Preview Course <i class="fas fa-eye ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('courses.publishedCourse') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-6 py-3 rounded-full transition duration-300">
                    View All Courses <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from our successful students who transformed their careers with EduVerse</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Student" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Jessica Chen</h4>
                            <p class="text-yellow-500 text-sm">Web Development Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The Web Development Bootcamp completely changed my career trajectory. Within 6 months of completing the course, I landed my first developer job with a 50% salary increase!"</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Michael Rodriguez</h4>
                            <p class="text-yellow-500 text-sm">Data Science Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The instructors are incredibly knowledgeable and the course materials are top-notch. The hands-on projects gave me the practical experience I needed to transition into data science."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Student" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Sarah Johnson</h4>
                            <p class="text-yellow-500 text-sm">Digital Marketing Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"I was able to apply what I learned immediately to grow my small business. The course paid for itself within the first month through improved marketing strategies."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Career?</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-8">Join thousands of students who have already started their learning journey with EduVerse University</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-8 py-3 rounded-full transition duration-300 transform hover:scale-105">
                    <a href="{{ route('courses.publishedCourse') }}" class="flex items-center justify-center">
                        <i class="fas fa-book-open mr-2"></i> Browse Courses
                    </a>
                </button>
                <button class="bg-transparent hover:bg-white hover:text-gray-900 text-white font-bold px-8 py-3 rounded-full border-2 border-white transition duration-300 transform hover:scale-105">
                    <a href="#" class="flex items-center justify-center">
                        <i class="fas fa-question-circle mr-2"></i> Get More Info
                    </a>
                </button>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
   <x-footer/>
</body>
</html>
