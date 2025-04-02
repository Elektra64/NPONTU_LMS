<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse | Gear Up Your Skills with Free Online Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #1e293b 100%);
        }
        .glow-text {
            text-shadow: 0 0 10px rgba(245, 158, 11, 0.7);
        }
        .hover-grow {
            transition: all 0.3s ease;
        }
        .hover-grow:hover {
            transform: scale(1.05);
        }
        .feature-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }
        .feature-card:hover {
            background: rgba(245, 158, 11, 0.1);
            transform: translateY(-5px);
        }
        .course-card {
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .cta-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .skill-badge {
            transition: all 0.3s ease;
        }
        .skill-badge:hover {
            transform: scale(1.1);
            background: rgba(245, 158, 11, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Animated Navbar -->
    <nav class="bg-gray-900/90 backdrop-blur-md text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg border-b border-gray-800">
        <div class="flex items-center space-x-8">
            <span class="text-2xl font-bold text-yellow-400 flex items-center hover-grow">
                <a href="/" class="cursor-pointer">
                    <i class="fas fa-graduation-cap mr-2"></i>EduVerse
                </a>
            </span>
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('courses.publishedCourse') }}" class="hover:text-yellow-400 transition duration-300 flex items-center nav-link">
                    <i class="fas fa-book-open mr-2"></i>Courses
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center nav-link">
                    <i class="fas fa-laptop-code mr-2"></i>Skill Paths
                </a>
                <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center nav-link">
                    <i class="fas fa-certificate mr-2"></i>Certificates
                </a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 text-gray-300 hover:text-white transition duration-300">
                Sign In
            </a>
            <a href="{{ route('signUp') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-6 py-2 rounded-full transition duration-300 transform hover:scale-105">
                Learn Free <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </nav>

    <!-- Hero Section with Particle Background -->
    <section class="relative hero-gradient overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div id="particles-js" class="w-full h-full"></div>
        </div>
        <div class="container mx-auto px-4 py-32 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    <span class="text-yellow-400 glow-text">Gear Up</span> Your Skills with <span class="text-yellow-400 glow-text">Free</span> Learning
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-3xl mx-auto">
                    Master in-demand skills at your own pace with our comprehensive courses.
                    <span class="font-semibold text-yellow-400">Earn certificates to showcase your achievements!</span>
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('signUp') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-8 py-4 rounded-full transition duration-300 transform hover:scale-105 flex items-center justify-center cta-pulse">
                        <i class="fas fa-rocket mr-2"></i> Start Learning Free
                    </a>
                    <a href="{{ route('courses.publishedCourse') }}" class="bg-transparent hover:bg-white/10 text-white font-bold px-8 py-4 rounded-full border-2 border-yellow-400 transition duration-300 transform hover:scale-105 flex items-center justify-center">
                        <i class="fas fa-book-open mr-2"></i> Browse Courses
                    </a>
                </div>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-check-circle text-yellow-400 mr-2"></i>
                        <span>100% Free Access</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-check-circle text-yellow-400 mr-2"></i>
                        <span>Learn at Your Own Pace</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-check-circle text-yellow-400 mr-2"></i>
                        <span>Certificates Included</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-900 to-transparent z-10"></div>
    </section>

    <!-- Skills Showcase Section -->
    <!-- Skills Showcase Section -->
<section class="py-16 relative overflow-hidden">
    <!-- Dotted gradient circular background -->
    <div class="absolute inset-0 z-0 flex items-center justify-center">
        <div class="relative w-full h-full">
            <!-- Large dotted circle -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                        w-[120%] h-[120%] max-w-[800px] max-h-[800px]
                        bg-[radial-gradient(circle,rgba(245,158,11,0.1)_2px,transparent_2px)]
                        bg-[length:20px_20px] opacity-40">
            </div>
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-transparent to-gray-900 opacity-90"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Develop <span class="text-yellow-400">In-Demand</span> Skills</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">Choose your path and build career-ready skills on your schedule</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="font-semibold text-lg">Web Development</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="font-semibold text-lg">Data Science</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <h3 class="font-semibold text-lg">UX/UI Design</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="font-semibold text-lg">Digital Marketing</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="font-semibold text-lg">App Development</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-cloud"></i>
                </div>
                <h3 class="font-semibold text-lg">Cloud Computing</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="font-semibold text-lg">AI & Machine Learning</h3>
            </div>
            <div class="skill-badge bg-gray-800/80 hover:bg-gray-700/90 p-6 rounded-xl text-center border border-gray-700 backdrop-blur-sm">
                <div class="text-yellow-400 text-4xl mb-3">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="font-semibold text-lg">Cybersecurity</h3>
            </div>
        </div>
    </div>
</section>

    <!-- Value Proposition Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Learn <span class="text-yellow-400">Your Way</span> at EduVerse</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Flexible learning designed to fit your life and schedule</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card p-8 rounded-xl border border-gray-800 hover-grow">
                    <div class="text-yellow-400 text-4xl mb-6">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Self-Paced Learning</h3>
                    <p class="text-gray-400">Progress through courses at your own speed with 24/7 access to all materials. Learn when it's convenient for you.</p>
                </div>
                <div class="feature-card p-8 rounded-xl border border-gray-800 hover-grow">
                    <div class="text-yellow-400 text-4xl mb-6">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Hands-On Projects</h3>
                    <p class="text-gray-400">Build real portfolio-worthy projects that demonstrate your skills to potential employers.</p>
                </div>
                <div class="feature-card p-8 rounded-xl border border-gray-800 hover-grow">
                    <div class="text-yellow-400 text-4xl mb-6">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Earn Certificates</h3>
                    <p class="text-gray-400">Get verifiable certificates for every completed course to showcase on your resume and LinkedIn profile.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section with Animated Counters -->
    <section class="py-20 bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2 counter" data-target="50000">0</div>
                    <div class="text-gray-300 uppercase text-sm">Free Courses</div>
                </div>
                <div class="p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2 counter" data-target="95">0</div>
                    <div class="text-gray-300 uppercase text-sm">Completion Rate</div>
                </div>
                <div class="p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2 counter" data-target="1000">0</div>
                    <div class="text-gray-300 uppercase text-sm">Hours of Content</div>
                </div>
                <div class="p-6">
                    <div class="text-5xl font-bold text-yellow-400 mb-2 counter" data-target="25000">0</div>
                    <div class="text-gray-300 uppercase text-sm">Certificates Earned</div>
                </div>
            </div>
        </div>
    </section>



    <!-- Final CTA Section -->
    <section class="py-24 bg-gradient-to-r from-gray-800 to-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://preview.redd.it/4wq6z8v8f3q81.png?width=640&crop=smart&auto=webp&s=9c3b3b0e8c3c7c5d5b5d5b5d5b5d5b5d5b5d5b5')] bg-cover bg-center"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Ready to <span class="text-yellow-400">Gear Up</span> Your Skills?
                </h2>
                <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto">
                    Join our community of learners and start building in-demand skills today - completely free!
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('signUp') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-8 py-4 rounded-full transition duration-300 transform hover:scale-105 flex items-center justify-center cta-pulse">
                        <i class="fas fa-user-graduate mr-2"></i> Start Learning Free
                    </a>

                </div>
                <div class="mt-8 flex justify-center">
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-certificate text-yellow-400 mr-2"></i>
                        <span class="font-medium">Earn free certificates with every completed course</span>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Particle.js Script -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
</body>
</html>
