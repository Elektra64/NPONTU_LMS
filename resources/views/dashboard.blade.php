<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#4A5568',
                        'secondary': '#718096',
                        'background': '#F7FAFC',
                        'accent-light': '#E2E8F0',
                        'accent-dark': '#2D3748',
                        'fine-color': '#A1DBF1'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-in-left': 'slideInLeft 0.5s ease-out',
                        'pulse-slow': 'pulse 2s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideInLeft: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
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
    <!-- Main Dashboard Layout -->
    <div class="flex flex-col min-h-screen">
        <!-- Top Navigation Bar -->
        <nav class="bg-fine-color shadow-md z-10 fixed w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <a href="/" class="flex items-center px-3 py-2 text-white hover:bg-accent-light rounded-md transition-colors">
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
            <!-- Top Header -->
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-accent-dark">Admin Dashboard</h1>
                <div class="text-sm text-gray-500">
                    Last updated: <span id="lastUpdatedTime">Just now</span>
                </div>
            </header>

            <!-- Dashboard Statistics -->
            <div class="grid sm:grid-cols-4 gap-6 mb-6">
                <!-- Total Courses Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 3H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM12 7v10M7 12h10"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Total Courses</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="totalCourses">42</p>
                    <p class="text-sm text-green-600 mt-2">+5 this month</p>
                </div>

                <!-- Active Users Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="2" x2="12" y2="12"></line>
                            <line x1="12" y1="12" x2="16" y2="8"></line>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Active Users</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="activeUsers">1,256</p>
                    <div class="flex items-center mt-2">
                        <span class="text-sm text-green-600 mr-2">+12% growth</span>
                        <span class="text-xs text-gray-500">(24h)</span>
                    </div>
                </div>

                <!-- Course Enrollments Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h18v18H3z"></path>
                            <path d="M12 7v10"></path>
                            <path d="M7 12h10"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Course Enrollments</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="courseEnrollments">587</p>
                    <div class="flex justify-between mt-2">
                        <span class="text-sm text-green-600">Completed: 500</span>
                        <span class="text-sm text-yellow-600">Pending: 87</span>
                    </div>
                </div>

                <!-- Total Quizzes Card -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-primary mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v2M12 18v2M4 12h2M16 12h2M7 5l2 2M17 5l-2 2M7 19l2-2M17 19l-2-2"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-600">Total Quizzes</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary" id="totalQuizzes">25</p>
                    <p class="text-sm text-green-600 mt-2">25 Assessments created</p>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-6 mb-6">
                <!-- Recent Courses Section -->
                <div class="bg-white rounded-lg shadow-md lg:col-span-2">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-accent-dark">Recent Courses</h2>
                        <a href="{{ route('courses') }}" class="text-green-600 hover:underline">View All</a>
                    </div>
                    <div id="courseGrid" class="grid md:grid-cols-2 gap-6 p-6">
                        <!-- Course cards will be dynamically inserted here -->
                    </div>
                </div>

                <!-- Recent Activities Section -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-accent-dark">Recent Activities</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New course published</p>
                                    <p class="text-sm text-gray-500">"Advanced JavaScript Patterns" was published by Admin</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New user registration</p>
                                    <p class="text-sm text-gray-500">John Doe registered as a student</p>
                                    <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Quiz completed</p>
                                    <p class="text-sm text-gray-500">Sarah completed "HTML Basics" quiz with 92% score</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">System update</p>
                                    <p class="text-sm text-gray-500">Platform updated to version 2.3.1</p>
                                    <p class="text-xs text-gray-400 mt-1">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Enrollment Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-accent-dark mb-4">Course Enrollments</h2>
                    <canvas id="enrollmentChart"></canvas>
                </div>

                <!-- User Activity Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-accent-dark mb-4">User Activity</h2>
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Course Details Modal -->
    <div id="courseDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 id="courseDetailsTitle" class="text-2xl font-bold text-accent-dark">Course Details</h2>
                <button onclick="closeDetailsModal()" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="courseDetailsContent" class="p-6">
                <!-- Course details will be loaded here dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Course Data - Synced with course management page
        let courses = [
            {
                id: "web-dev-masterclass",
                title: "Web Development Masterclass",
                category: "Web Development",
                difficulty: "Intermediate",
                description: "Learn full-stack web development with modern technologies",
                duration_weeks: 12,
                hours_per_week: 8,
                video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                final_exam: {
                    weight: 30,
                    passing_score: 70
                },
                modules: [
                    {
                        title: "HTML & CSS Fundamentals",
                        duration_days: 14,
                        description: "Learn the building blocks of web development",
                        quiz_weight: 20,
                        questions: [
                            {
                                text: "What does HTML stand for?",
                                options: ["Hyper Text Markup Language", "Hyperlinks and Text Markup Language", "Home Tool Markup Language"],
                                correct: 0
                            }
                        ]
                    }
                ],
                enrollments: 245,
                status: "Published",
                lastUpdated: "2 days ago",
                created_at: new Date('2023-05-15'),
                imageUrl: "/webdev.jpg"
            },
            {
                id: "data-science-bootcamp",
                title: "Data Science Bootcamp",
                category: "Data Science",
                difficulty: "Beginner",
                description: "Introduction to data science and machine learning",
                duration_weeks: 10,
                hours_per_week: 6,
                video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                final_exam: {
                    weight: 25,
                    passing_score: 65
                },
                modules: [
                    {
                        title: "Python for Data Science",
                        duration_days: 10,
                        description: "Learn Python basics for data analysis",
                        quiz_weight: 15,
                        questions: [
                            {
                                text: "Which library is used for numerical operations in Python?",
                                options: ["NumPy", "Pandas", "Matplotlib"],
                                correct: 0
                            }
                        ]
                    }
                ],
                enrollments: 320,
                status: "Published",
                lastUpdated: "1 week ago",
                created_at: new Date('2023-06-10'),
                imageUrl: "/webdev.jpg"
            },
            {
                id: "advanced-javascript",
                title: "Advanced JavaScript Patterns",
                category: "Web Development",
                difficulty: "Advanced",
                description: "Master advanced JavaScript concepts and patterns",
                duration_weeks: 8,
                hours_per_week: 10,
                video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                final_exam: {
                    weight: 35,
                    passing_score: 75
                },
                modules: [
                    {
                        title: "Design Patterns in JS",
                        duration_days: 12,
                        description: "Learn common JavaScript design patterns",
                        quiz_weight: 25,
                        questions: [
                            {
                                text: "Which pattern is used for creating objects?",
                                options: ["Factory", "Observer", "Singleton"],
                                correct: 0
                            }
                        ]
                    }
                ],
                enrollments: 180,
                status: "Published",
                lastUpdated: "Just now",
                created_at: new Date('2023-07-05'),
                imageUrl: "/webdev.jpg"
            }
        ];

        // User Activity Data
        const userActivityData = {
            labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
            datasets: [
                {
                    label: 'Active Users',
                    data: [120, 80, 250, 400, 350, 280],
                    backgroundColor: 'rgba(74, 85, 104, 0.2)',
                    borderColor: 'rgba(74, 85, 104, 1)',
                    borderWidth: 1,
                    tension: 0.4,
                    fill: true
                }
            ]
        };

        // Function to view course details
        function viewCourseDetails(courseId) {
            const course = courses.find(c => c.id === courseId);
            if (!course) {
                alert('Course not found');
                return;
            }

            // Populate modal with course details
            document.getElementById('courseDetailsTitle').textContent = course.title;

            // Format modules and questions
            const modulesHtml = course.modules.map(module => `
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-xl font-semibold mb-2">${module.title}</h3>
                    <div class="flex items-center text-sm text-gray-600 mb-3">
                        <span class="mr-4">Duration: ${module.duration_days} days</span>
                        <span>Quiz Weight: ${module.quiz_weight}%</span>
                    </div>
                    <p class="text-gray-700 mb-4">${module.description}</p>

                    ${module.questions.length > 0 ? `
                    <h4 class="font-medium mb-2">Quiz Questions:</h4>
                    <div class="space-y-3">
                        ${module.questions.map((question, qIndex) => `
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="font-medium">Question ${qIndex + 1}: ${question.text}</p>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                ${question.options.map((option, oIndex) => `
                                <div class="flex items-center">
                                    <span class="mr-2">${String.fromCharCode(65 + oIndex)}.</span>
                                    <span class="${oIndex === question.correct ? 'text-green-600 font-medium' : ''}">${option}</span>
                                </div>
                                `).join('')}
                            </div>
                        </div>
                        `).join('')}
                    </div>
                    ` : '<p class="text-gray-500">No quiz questions for this module</p>'}
                </div>
            `).join('');

            // Create the full course details HTML
            const courseDetailsHtml = `
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Course Overview</h3>
                    <p class="text-gray-700 mb-4">${course.description}</p>
                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-500">Category</p>
                            <p class="font-medium">${course.category}</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-500">Difficulty</p>
                            <p class="font-medium">${course.difficulty}</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-500">Enrollments</p>
                            <p class="font-medium">${course.enrollments}</p>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="font-medium">${course.duration_weeks} weeks (${course.hours_per_week} hrs/week)</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-500">Final Exam</p>
                            <p class="font-medium">Weight: ${course.final_exam.weight}% (Pass: ${course.final_exam.passing_score}%)</p>
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-semibold mb-4">Course Modules</h3>
                ${modulesHtml}

                ${course.video_url ? `
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Course Preview</h3>
                    <div class="aspect-w-16 aspect-h-9 bg-black rounded overflow-hidden">
                        <iframe src="${course.video_url}" class="w-full h-64" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                ` : ''}
            `;

            document.getElementById('courseDetailsContent').innerHTML = courseDetailsHtml;

            // Show the modal
            document.getElementById('courseDetailsModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close modal function
        function closeDetailsModal() {
            document.getElementById('courseDetailsModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Update statistics
            updateStatistics();

            // Render recent courses
            renderRecentCourses();

            // Initialize charts
            initEnrollmentChart();
            initUserActivityChart();

            // Set last updated time
            updateLastUpdatedTime();

            // Refresh data every 5 minutes
            setInterval(updateDashboardData, 300000);

            // Close modal when clicking outside content
            document.getElementById('courseDetailsModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDetailsModal();
                }
            });
        });

        // Update dashboard statistics
        function updateStatistics() {
            document.getElementById('totalCourses').textContent = courses.length;

            // Calculate active users (simulated)
            const activeUsers = Math.floor(Math.random() * 500) + 1000;
            document.getElementById('activeUsers').textContent = activeUsers.toLocaleString();

            // Calculate total enrollments
            const totalEnrollments = courses.reduce((sum, course) => sum + course.enrollments, 0);
            document.getElementById('courseEnrollments').textContent = totalEnrollments;
        }

        // Render recent courses (last 3 added)
        function renderRecentCourses() {
            const courseGrid = document.getElementById('courseGrid');

            // Sort courses by creation date (newest first)
            const sortedCourses = [...courses].sort((a, b) => b.created_at - a.created_at).slice(0, 3);

            courseGrid.innerHTML = sortedCourses.map(course => `
                <div class="course-card bg-white border rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold mb-2">${course.title}</h3>
                        <div class="flex justify-between items-center mb-3">
                            <span class="${getCategoryBadgeClasses(course.category)} px-2 py-1 rounded-full text-xs">${course.category}</span>
                            <span class="${getDifficultyBadgeClasses(course.difficulty)} px-2 py-1 rounded-full text-xs">${course.difficulty}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">${course.enrollments} enrollments</span>
                            <span class="text-gray-500">${course.lastUpdated}</span>
                        </div>
                        <div class="mt-4 flex justify-center">
                            <button onclick="viewCourseDetails('${course.id}')" class="text-blue-600 hover:text-blue-800 text-sm font-medium px-4 py-2 bg-blue-50 rounded-md">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Initialize enrollment chart
        function initEnrollmentChart() {
            const ctx = document.getElementById('enrollmentChart').getContext('2d');

            // Prepare enrollment data by month
            const enrollmentData = Array(12).fill(0);
            courses.forEach(course => {
                const month = course.created_at.getMonth();
                enrollmentData[month] += course.enrollments;
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Course Enrollments',
                        data: enrollmentData,
                        backgroundColor: 'rgba(74, 85, 104, 0.7)',
                        borderColor: 'rgba(74, 85, 104, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Initialize user activity chart
        function initUserActivityChart() {
            const ctx = document.getElementById('userActivityChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: userActivityData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Update last updated time
        function updateLastUpdatedTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            document.getElementById('lastUpdatedTime').textContent =
                `Today at ${now.toLocaleTimeString('en-US', options)}`;
        }

        // Simulate data refresh
        function updateDashboardData() {
            // Simulate some data changes
            courses.forEach(course => {
                // Randomly increase enrollments
                if (Math.random() > 0.7) {
                    course.enrollments += Math.floor(Math.random() * 10);
                }
            });

            // Update the UI
            updateStatistics();
            renderRecentCourses();
            updateLastUpdatedTime();

            // Show notification
            showNotification('Dashboard data refreshed');
        }

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg animate-fade-in';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('animate-fade-in');
                notification.classList.add('animate-fade-out');
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Helper functions for badge styling
        function getCategoryBadgeClasses(category) {
            const categoryClasses = {
                'Web Development': 'bg-green-100 text-green-800',
                'Data Science': 'bg-purple-100 text-purple-800',
                'Design': 'bg-blue-100 text-blue-800',
                'Marketing': 'bg-yellow-100 text-yellow-800',
                'Business': 'bg-gray-100 text-gray-800'
            };
            return categoryClasses[category] || 'bg-gray-100 text-gray-800';
        }

        function getDifficultyBadgeClasses(difficulty) {
            const difficultyClasses = {
                'Beginner': 'bg-green-100 text-green-800',
                'Intermediate': 'bg-yellow-100 text-yellow-800',
                'Advanced': 'bg-red-100 text-red-800'
            };
            return difficultyClasses[difficulty] || 'bg-gray-100 text-gray-800';
        }
    </script>
</body>
</html>
