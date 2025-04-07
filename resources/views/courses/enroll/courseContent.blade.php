
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course['title'] }} | EduVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <style>
        /* Progress bar styles */
        .progress-bar {
            height: 6px;
            transition: width 0.3s ease;
        }

        /* Lesson item styles */
        .lesson-item:hover {
            background-color: #f3f4f6;
        }
        .lesson-item.active {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
        }
        .lesson-item.completed {
            border-left: 4px solid #10b981;
        }

        /* Video container styles */
        .video-container {
            aspect-ratio: 16/9;
        }
        .video-js {
            width: 100%;
            height: 100%;
        }
        .vjs-big-play-button {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Quiz styles */
        .quiz-container {
            background-color: #f8fafc;
            border-radius: 0.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .quiz-question {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .quiz-question:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .quiz-option {
            display: block;
            padding: 0.75rem 1rem;
            margin: 0.5rem 0;
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .quiz-option:hover {
            background-color: #f1f5f9;
        }
        .quiz-option.selected {
            background-color: #dbeafe;
            border-color: #3b82f6;
        }
        .quiz-option.correct {
            background-color: #d1fae5;
            border-color: #10b981;
        }
        .quiz-option.incorrect {
            background-color: #fee2e2;
            border-color: #ef4444;
        }
        .quiz-feedback {
            margin-top: 0.5rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
            display: none;
        }
        .quiz-feedback.correct {
            background-color: #d1fae5;
            color: #065f46;
            display: block;
        }
        .quiz-feedback.incorrect {
            background-color: #fee2e2;
            color: #b91c1c;
            display: block;
        }
        .quiz-results {
            display: none;
            padding: 1.5rem;
            margin-top: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .quiz-results.passed {
            background-color: #d1fae5;
            color: #065f46;
        }
        .quiz-results.failed {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        #quiz-progress {
            height: 6px;
            background-color: #e2e8f0;
            border-radius: 3px;
            margin-bottom: 1rem;
        }
        #quiz-progress-bar {
            height: 100%;
            width: 0%;
            background-color: #3b82f6;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        /* Lesson content styles */
        .lesson-content {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .explanation-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .explanation-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .method-item {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .method-step {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .method-step:before {
            content: counter(step);
            counter-increment: step;
            position: absolute;
            left: 0;
            background-color: #3b82f6;
            color: white;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-lg">
        <div class="flex items-center space-x-4">
            <a href="/" class="text-xl font-bold text-yellow-400">
                <i class="fas fa-graduation-cap mr-2"></i>EduVerse
            </a>
            <span class="text-gray-300">|</span>
            <span class="hidden md:block">Course Content</span>
        </div>
        <div class="flex items-center space-x-4">
            <button id="save-progress-btn" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-full text-sm font-medium transition">
                <i class="fas fa-save mr-2"></i>Save Progress
            </button>
            <div class="flex items-center space-x-2">
                <img src="{{ $user['avatar'] ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="User" class="w-8 h-8 rounded-full border-2 border-yellow-400">
                <span class="hidden md:inline text-sm">{{ $user['name'] ?? 'Guest' }}</span>
            </div>
        </div>
    </nav>

    <div class="flex flex-col md:flex-row">
        <!-- Sidebar - Course Content Navigation -->
        <div class="w-full md:w-80 bg-white shadow-md md:h-[calc(100vh-4rem)] sticky top-16 overflow-y-auto">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">{{ $course['title'] }}</h2>
                <div class="flex items-center mt-2 text-sm text-gray-600">
                    <span class="mr-2">{{ $course['instructor'] }}</span>
                    <span class="text-yellow-500">
                        <i class="fas fa-star"></i> {{ $course['rating'] }}
                    </span>
                </div>

                <!-- Progress Tracker -->
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Course Progress</span>
                        <span id="progress-percent">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div id="progress-bar" class="progress-bar bg-yellow-500 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <!-- Course Sections -->
            <div class="divide-y">
                @foreach($content['sections'] as $sectionIndex => $section)
                <div class="p-4">
                    <div class="flex justify-between items-center cursor-pointer">
                        <h3 class="font-medium text-gray-800">
                            <i class="fas fa-folder-open text-yellow-500 mr-2"></i>
                            Section {{ $sectionIndex + 1 }}: {{ $section['title'] }}
                        </h3>
                        <span class="text-gray-500 text-sm">{{ count($section['lessons']) }} lessons</span>
                    </div>

                    <!-- Lessons List -->
                    <div class="mt-2 ml-8 space-y-1">
                        @foreach($section['lessons'] as $lessonIndex => $lesson)
                        <a href="{{ route('course.lesson', ['courseId' => $course['id'], 'section' => $sectionIndex, 'lesson' => $lessonIndex]) }}"
                           class="block px-3 py-2 text-sm rounded lesson-item
                                  {{ $currentSection == $sectionIndex && $currentLesson == $lessonIndex ? 'active' : '' }}
                                  {{ $lesson['completed'] ?? false ? 'completed' : '' }}"
                           data-section-index="{{ $sectionIndex }}"
                           data-lesson-index="{{ $lessonIndex }}">
                            <div class="flex items-center">
                                @if($currentSection == $sectionIndex && $currentLesson == $lessonIndex)
                                <i class="fas fa-play-circle text-yellow-500 mr-2"></i>
                                @elseif($lesson['completed'] ?? false)
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                @else
                                <i class="far fa-circle text-gray-400 mr-2"></i>
                                @endif
                                <span>{{ $lesson['title'] }}</span>
                                <span class="ml-auto text-xs text-gray-500">{{ $lesson['duration'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6">
            <div class="max-w-4xl mx-auto">
                <!-- Current Lesson Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span>Section {{ $currentSection + 1 }} of {{ count($content['sections']) }}</span>
                        <span class="mx-2">•</span>
                        <span>Lesson {{ $currentLesson + 1 }} of {{ count($content['sections'][$currentSection]['lessons']) }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $content['sections'][$currentSection]['lessons'][$currentLesson]['title'] }}
                    </h1>
                </div>

                @php
                    $currentLessonData = $content['sections'][$currentSection]['lessons'][$currentLesson];
                @endphp

                <!-- Lesson Content -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <!-- Video Player -->
                    @if($currentLessonData['type'] === 'video')
                    <div class="video-container">
                        <video
                            id="lesson-video"
                            class="video-js vjs-big-play-centered"
                            controls
                            preload="auto"
                            data-setup='{}'
                        >
                            <source src="{{ $currentLessonData['video_url'] }}" type="video/mp4">
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                    @else
                    <div class="video-container bg-gray-100 flex items-center justify-center">
                        <div class="text-center p-8">
                            <i class="fas fa-file-alt text-5xl text-gray-400 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-700">Reading Material</h3>
                            <p class="text-gray-500 mt-2">This lesson contains written content to review</p>
                        </div>
                    </div>
                    @endif

                    <!-- Lesson Details -->
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex space-x-2">
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                    {{ $currentLessonData['type'] ?? 'Video' }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                    {{ $currentLessonData['duration'] }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                @if($currentLessonData['type'] === 'video')
                                <button id="speed-control" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full text-sm">
                                    1x Speed
                                </button>
                                @endif
                                <button id="mark-complete-btn" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-full text-sm">
                                    <i class="fas fa-check mr-2"></i>Mark as Complete
                                </button>
                            </div>
                        </div>

                        <!-- Lesson Content Sections -->
                        <div class="space-y-6">
                            <!-- Lesson Overview -->
                            @if(isset($currentLessonData['content']['overview']))
                            <div class="lesson-content">
                                <h3 class="text-lg font-bold mb-3">Lesson Overview</h3>
                                <p class="text-gray-700">{{ $currentLessonData['content']['overview'] }}</p>
                            </div>
                            @endif

                            <!-- Explanations -->
                            @if(isset($currentLessonData['content']['explanations']) && count($currentLessonData['content']['explanations']) > 0)
                            <div class="lesson-content">
                                <h3 class="text-lg font-bold mb-3">Key Concepts</h3>
                                @foreach($currentLessonData['content']['explanations'] as $explanation)
                                <div class="explanation-item">
                                    <h4 class="font-semibold text-gray-800 mb-2">{{ $explanation['title'] }}</h4>
                                    <p class="text-gray-700">{{ $explanation['content'] }}</p>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <!-- Methods -->
                            @if(isset($currentLessonData['content']['methods']) && count($currentLessonData['content']['methods']) > 0)
                            <div class="lesson-content">
                                <h3 class="text-lg font-bold mb-3">Methods & Procedures</h3>
                                @foreach($currentLessonData['content']['methods'] as $method)
                                <div class="method-item">
                                    <h4 class="font-semibold text-gray-800 mb-2">{{ $method['name'] }}</h4>
                                    <div class="space-y-2" style="counter-reset: step;">
                                        @foreach($method['steps'] as $step)
                                        <div class="method-step text-gray-700">{{ $step }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Resources -->
                        @if(isset($currentLessonData['resources']) && count($currentLessonData['resources']) > 0)
                        <div class="mt-6 pt-4 border-t">
                            <h4 class="font-medium text-gray-900 mb-3">Lesson Resources</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($currentLessonData['resources'] as $resource)
                                <a href="{{ $resource['url'] ?? '#' }}" class="flex items-center p-3 border rounded-lg hover:bg-gray-50" target="_blank">
                                    @if($resource['type'] == 'pdf')
                                    <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                    @elseif($resource['type'] == 'exercise')
                                    <i class="fas fa-code text-blue-500 text-xl mr-3"></i>
                                    @elseif($resource['type'] == 'dataset')
                                    <i class="fas fa-database text-purple-500 text-xl mr-3"></i>
                                    @else
                                    <i class="fas fa-link text-gray-500 text-xl mr-3"></i>
                                    @endif
                                    <span>{{ $resource['title'] }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Lesson Quiz (if exists) -->
                @if(isset($currentLessonData['quiz']))
                <div id="quiz-container" class="quiz-container">
                    <h2 class="text-xl font-bold mb-4">{{ $currentLessonData['quiz']['title'] }}</h2>
                    <p class="text-gray-600 mb-6">{{ $currentLessonData['quiz']['instructions'] ?? 'Test your understanding of this lesson' }}</p>

                    <div id="quiz-progress">
                        <div id="quiz-progress-bar"></div>
                    </div>

                    <form id="quiz-form">
                        @foreach($currentLessonData['quiz']['questions'] as $index => $question)
                        <div class="quiz-question" data-question-index="{{ $index }}">
                            <h3 class="font-medium mb-3">{{ $index + 1 }}. {{ $question['question'] }}</h3>
                            <div class="space-y-2">
                                @foreach($question['options'] as $optionIndex => $option)
                                <label class="quiz-option">
                                    <input type="radio" name="question_{{ $index }}" value="{{ $optionIndex }}" class="hidden">
                                    <span>{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>
                            <div class="quiz-feedback" data-correct="{{ $question['correct'] }}">
                                <p>{{ $question['explanation'] }}</p>
                            </div>
                        </div>
                        @endforeach

                        <div id="quiz-results" class="quiz-results">
                            <h3 class="text-lg font-bold mb-2"></h3>
                            <p class="mb-4"></p>
                            <button type="button" id="quiz-retry-btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded mr-2 hidden">
                                <i class="fas fa-redo mr-2"></i>Try Again
                            </button>
                            <button type="button" id="quiz-continue-btn" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded hidden">
                                Continue <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>

                        <div class="mt-6 text-right">
                            <button type="submit" id="quiz-submit-btn" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium">
                                Submit Quiz <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- Final Quiz (Only shown on last lesson) -->
                @if(!($navigation['next'] ?? false) && isset($content['final_quiz']))
                <div id="final-quiz-container" class="quiz-container mt-8">
                    <h2 class="text-2xl font-bold mb-4">Course Final Assessment</h2>
                    <p class="text-gray-600 mb-6">Test your knowledge before completing the course. You need to score at least {{ $content['final_quiz']['passing_score'] }}% to pass.</p>

                    <div id="final-quiz-progress">
                        <div id="final-quiz-progress-bar"></div>
                    </div>

                    <form id="final-quiz-form">
                        @foreach($content['final_quiz']['questions'] as $index => $question)
                        <div class="quiz-question" data-question-index="{{ $index }}">
                            <h3 class="font-medium mb-3">{{ $index + 1 }}. {{ $question['question'] }}</h3>
                            <div class="space-y-2">
                                @foreach($question['options'] as $optionIndex => $option)
                                <label class="quiz-option">
                                    <input type="radio" name="question_{{ $index }}" value="{{ $optionIndex }}" class="hidden">
                                    <span>{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>
                            <div class="quiz-feedback" data-correct="{{ $question['correct'] }}">
                                <p>{{ $question['explanation'] }}</p>
                            </div>
                        </div>
                        @endforeach

                        <div id="final-quiz-results" class="quiz-results">
                            <h3 class="text-xl font-bold mb-2"></h3>
                            <p class="mb-4"></p>
                            <button type="button" id="final-quiz-retry-btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded mr-2 hidden">
                                <i class="fas fa-redo mr-2"></i>Try Again
                            </button>
                            <button type="button" id="final-quiz-continue-btn" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded hidden">
                                Complete Course <i class="fas fa-trophy ml-2"></i>
                            </button>
                        </div>

                        <div class="mt-6 text-right">
                            <button type="submit" id="final-quiz-submit-btn" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium">
                                Submit Final Quiz <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="flex justify-between">
                    @if($navigation['prev'] ?? false)
                    <a href="{{ route('course.lesson', ['courseId' => $course['id'], 'section' => $navigation['prev']['section'], 'lesson' => $navigation['prev']['lesson']]) }}"
                       class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Previous Lesson
                    </a>
                    @else
                    <span></span>
                    @endif

                    @if($navigation['next'] ?? false)
                    <a href="{{ route('course.lesson', ['courseId' => $course['id'], 'section' => $navigation['next']['section'], 'lesson' => $navigation['next']['lesson']]) }}"
                       class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium">
                        Next Lesson <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    @else
                    <form method="POST" action="{{ route('course.complete', $course['id']) }}" id="course-completion-form">
                        @csrf
                        <button type="submit"
                        class="px-6 py-3 text-white rounded-lg font-medium bg-green-500 hover:bg-green-600"
                        id="complete-course-btn">
                            Complete Course <i class="fas fa-trophy ml-2"></i>
                        </button>
                    </form>
                    @endif
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
    

    <!-- JavaScript libraries -->
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script src="{{ asset('assets/js/courseContents.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize course progress
          // Initialize course progress
          const courseProgress = new CourseProgress(
        {{ $course['id'] }},
        {{ $currentSection }},
        {{ $currentLesson }},
        {{ array_reduce($content['sections'], function($carry, $section) {
            return $carry + count($section['lessons']);
        }, 0) }},
        {{ isset($content['final_quiz']) ? 'true' : 'false' }},
        {{ isset($content['final_quiz']) ? $content['final_quiz']['passing_score'] : 0 }},
        @json($content) // Make sure this is passing the full course content
    );

        // Initialize video player if needed
        if ({{ $content['sections'][$currentSection]['lessons'][$currentLesson]['type'] === 'video' ? 'true' : 'false' }}) {
            const player = videojs('lesson-video', {
                controls: true,
                autoplay: false,
                preload: 'auto',
                fluid: true
            });

            const speedControl = document.getElementById('speed-control');
            if (speedControl) {
                const speeds = [0.5, 0.75, 1, 1.25, 1.5, 2];
                let currentSpeed = 2;
                speedControl.addEventListener('click', function() {
                    currentSpeed = (currentSpeed + 1) % speeds.length;
                    player.playbackRate(speeds[currentSpeed]);
                    this.textContent = speeds[currentSpeed] + 'x Speed';
                });
            }
        }
    });
</script>

</body>
</html>
