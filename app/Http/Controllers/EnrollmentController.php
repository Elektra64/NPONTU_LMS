<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Show enrollment verification page
    public function show($courseId)
    {
        $course = $this->getMockCourseData($courseId);
        if (!$course) {
            abort(404, 'Course not found');
        }
        return view('courses.enroll.verify', compact('course'));
    }

    public function verify(Request $request, $courseId)
    {
        $request->validate([
            'puzzle_solution' => 'required|string'
        ]);

        if (!$this->verifyPuzzleSolution($request->puzzle_solution)) {
            return back()->with('error', 'Puzzle verification failed. Please try again.');
        }

        // Store course data in session
        $course = $this->getMockCourseData($courseId);

        $request->session()->put('enrollment_data', [
            'course_id' => $courseId,
            'course_data' => $course, // Store entire course object
            'verified_at' => now(),
            'selected_package' => $request->input('package', 'free')
        ]);

        return redirect()->route('enroll.success', $courseId);
    }

    public function success(Request $request, $courseId)
    {
        // Get enrollment data from session
        $enrollmentData = $request->session()->get('enrollment_data');

        // Verify the course ID matches
        if (!$enrollmentData || $enrollmentData['course_id'] != $courseId) {
            return redirect()->route('enroll.show', $courseId);
        }

        $successData = [
            'course' => $enrollmentData['course_data'], // Use the stored course data
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ],
            'enrollment' => [
                'id' => uniqid(),
                'package' => $enrollmentData['selected_package'] ?? 'free',
                'completed' => false
            ],
            'has_paid_options' => $enrollmentData['course_data']['has_paid_options'] ?? false
        ];

        return view('courses.enroll.success', compact('successData'));
    }

    public function complete(Request $request, $courseId)
{
    // Validate request
    $validated = $request->validate([
        'package' => 'required|in:free,standard,premium',
        'terms' => 'required|accepted',
        'name' => 'required|string',
        'email' => 'required|email',
        'course_id' => 'required|numeric'
    ]);

    // Verify course ID matches
    if ($validated['course_id'] != $courseId) {
        return response()->json([
            'error' => 'Course mismatch detected',
            'redirect' => route('enroll.show', $courseId)
        ], 400);
    }

    // Get enrollment data from session
    $enrollmentData = $request->session()->get('enrollment_data');

    if (!$enrollmentData || $enrollmentData['course_id'] != $courseId) {
        return response()->json([
            'error' => 'Invalid enrollment session',
            'redirect' => route('enroll.show', $courseId)
        ], 400);
    }

    // Verify user data matches
    $expectedUser = [
        'name' => 'John Doe',
        'email' => 'john@example.com'
    ];

    if ($validated['name'] !== $expectedUser['name'] ||
        $validated['email'] !== $expectedUser['email']) {
        return response()->json([
            'error' => 'User verification failed',
            'redirect' => route('enroll.show', $courseId)
        ], 400);
    }

    // Create enrollment record (in real app, save to database)
    $enrollment = [
        'id' => uniqid(),
        'course_id' => $courseId,
        'package' => $validated['package'],
        'completed_at' => now()
    ];

    // Clear session data
    $request->session()->forget('enrollment_data');

    // Redirect to course content
    return response()->json([
        'success' => true,
        'redirect' => route('course.content', $courseId)
    ]);
}
    // Process final enrollment
    public function processEnrollment(Request $request, $courseId)
    {
        // Validate request
        $validated = $request->validate([
            'package' => 'required|in:free,standard,premium',
            'terms' => 'required|accepted'
        ]);

        // Get enrollment data from session
        $enrollmentData = $request->session()->get('enrollment_data');

        if (!$enrollmentData || $enrollmentData['course_id'] != $courseId) {
            return redirect()->route('enroll.success', $courseId);
        }

        // Clear session data
        $request->session()->forget('enrollment_data');

        return redirect()->route('enroll.complete', [
            'id' => $courseId,
            'package' => $validated['package']
        ]);
    }



    // Helper method to verify puzzle
    private function verifyPuzzleSolution($solution)
    {
        try {
            $pieces = json_decode($solution);
            return is_array($pieces) && count($pieces) === 6;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Helper method to generate mock course data
    public function getMockCourseData($courseId)
    {
        $mockCourses = [
            1 => [
                'id' => 1,
                'title' => "Complete Web Developer Bootcamp 2023",
                'instructor' => "Jane Smith",
                'category' => "Web Development",
                'description' => "Master HTML, CSS, JavaScript, React, Node.js and more with this comprehensive course.",
                'image' => "https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.9,
                'students_count' => 12345,
                'difficulty' => "beginner",
                'badge' => "BESTSELLER",
                'badgeColor' => "bg-yellow-500 text-black",
                'is_free' => true,
                'has_paid_options' => true,
                'price' => 49.99,
                'standard_price' => 49.99,
                'premium_price' => 99.99
            ],
            2 => [
                'id' => 2,
                'title' => "Data Science & Machine Learning",
                'instructor' => "John Doe",
                'category' => "Data Science",
                'description' => "Learn Python, Pandas, NumPy, Matplotlib, Scikit-learn, TensorFlow and more.",
                'image' => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.8,
                'students_count' => 8765,
                'difficulty' => "intermediate",
                'badge' => "NEW",
                'badgeColor' => "bg-blue-500 text-white",
                'is_free' => false,
                'has_paid_options' => true,
                'price' => 79.99,
                'standard_price' => 79.99,
                'premium_price' => 149.99
            ],
            3 => [
                'id' => 3,
                'title' => "Digital Marketing Masterclass",
                'instructor' => "Sarah Johnson",
                'category' => "Marketing",
                'description' => "SEO, Social Media, PPC, Email Marketing, Content Marketing, Analytics & More!",
                'image' => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.7,
                'students_count' => 6543,
                'difficulty' => "beginner",
                'badge' => "POPULAR",
                'badgeColor' => "bg-purple-500 text-white",
                'is_free' => true,
                'has_paid_options' => false,
                'price' => 0,
                'standard_price' => 29.99,
                'premium_price' => 59.99
            ],
            4 => [
                'id' => 4,
                'title' => "Business Fundamentals",
                'instructor' => "Michael Brown",
                'category' => "Business",
                'description' => "Learn the core concepts of business including finance, marketing, operations, and strategy.",
                'image' => "https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.8,
                'students_count' => 9876,
                'difficulty' => "beginner",
                'badge' => "BESTSELLER",
                'badgeColor' => "bg-yellow-500 text-black",
                'is_free' => false,
                'has_paid_options' => true,
                'price' => 59.99,
                'standard_price' => 59.99,
                'premium_price' => 119.99
            ],
            5 => [
                'id' => 5,
                'title' => "UI/UX Design Specialization",
                'instructor' => "Emily Wilson",
                'category' => "Design",
                'description' => "Master user interface and user experience design principles. Learn Figma, Adobe XD.",
                'image' => "https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.6,
                'students_count' => 5432,
                'difficulty' => "intermediate",
                'badge' => "TRENDING",
                'badgeColor' => "bg-red-500 text-white",
                'is_free' => true,
                'has_paid_options' => true,
                'price' => 0,
                'standard_price' => 39.99,
                'premium_price' => 79.99
            ],
            6 => [
                'id' => 6,
                'title' => "Flutter Mobile App Development",
                'instructor' => "David Lee",
                'category' => "Mobile Development",
                'description' => "Build cross-platform mobile apps with Flutter and Dart. Publish to App Stores.",
                'image' => "https://images.unsplash.com/photo-1610563166150-b34df4f3bcd6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
                'rating' => 4.5,
                'students_count' => 7654,
                'difficulty' => "advanced",
                'badge' => "FREE",
                'badgeColor' => "bg-green-500 text-white",
                'is_free' => true,
                'has_paid_options' => false,
                'price' => 0,
                'standard_price' => 49.99,
                'premium_price' => 89.99
            ]
        ];

        return $mockCourses[$courseId] ?? [
            'id' => $courseId,
            'title' => "Sample Course",
            'instructor' => "Default Instructor",
            'category' => "General",
            'description' => "This is a sample course description",
            'image' => "https://images.unsplash.com/photo-1501504905252-473c47e087f8",
            'rating' => 4.0,
            'students_count' => 1000,
            'difficulty' => "beginner",
            'badge' => "",
            'badgeColor' => "",
            'is_free' => true,
            'has_paid_options' => false,
            'price' => 0,
            'standard_price' => 29.99,
            'premium_price' => 49.99
        ];
    }

public function getAllCourses()
{
    return [
        $this->getMockCourseData(1),
        $this->getMockCourseData(2),
        $this->getMockCourseData(3),
        $this->getMockCourseData(4),
        $this->getMockCourseData(5),
        $this->getMockCourseData(6)
    ];
}
//shows verification page
public function showVerifyPage($courseId)
{
    $course = $this->getMockCourseData($courseId);
    if (!$course) {
        abort(404, 'Course not found');
    }
    return view('courses.enroll.verify', compact('course'));
}

// method to get popular courses on the homepage
// Add this method to your EnrollmentController
public function getPopularCourses($limit = 3)
{
    $allCourses = $this->getAllCourses();

    // Sort courses by students_count in descending order
    usort($allCourses, function($a, $b) {
        return $b['students_count'] <=> $a['students_count'];
    });

    // Return only the requested number of courses
    return array_slice($allCourses, 0, $limit);
}



//certificate method
// Add these methods to your EnrollmentController

public function showCertificate($enrollmentId)
{
    // Get course ID from request or enrollment data
    $courseId = request()->input('course_id') ?? 1; // Fallback to course 1 if not provided

    // Generate complete certificate data matching your template structure
    $certificate = [
        'user' => [
            'name' => request()->input('student_name', 'John Doe'), // Use submitted name or default
            'email' => 'john@example.com',
            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
        ],
        'course' => $this->getMockCourseData($courseId),
        'enrollment_id' => $enrollmentId,
        'completion_details' => [
            'score' => rand(85, 100),
            'grade' => $this->calculateGrade(rand(85, 100)),
            'completed_at' => now()->format('Y-m-d H:i:s')
        ],
        'instructor' => [
            'name' => $this->getMockCourseData($courseId)['instructor'],
            'title' => 'Senior Instructor'
        ],
        'institution' => [
            'name' => 'EduVerse Learning Platform',
            'seal' => 'https://unsplash.com/photos/a-gold-letter-with-a-green-background-Q-qBa2D9sdw',
            'signature' => null
        ],
        'certificate_info' => [
            'id' => 'CER-' . strtoupper(uniqid()),
            'issued_date' => now()->format('F j, Y'),
            'verification_code' => strtoupper(uniqid())
        ],
        'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' .
                    urlencode(route('certificate.show', $enrollmentId))
    ];

    return view('courses.enroll.certificate', [
        'certificate' => $certificate,
        'share_url' => route('certificate.show', $enrollmentId)
    ]);
}

public function generateCertificate($enrollmentId)
{
    // Generate PDF version of certificate
    // This is a placeholder - you'd use something like DomPDF or Laravel Snappy
    return response()->json([
        'success' => true,
        'download_url' => '/certificates/download/' . $enrollmentId
    ]);
}
public function showCourseContent($courseId)
{
    $course = $this->getMockCourseData($courseId);
    $content = $this->getMockCourseContent($courseId);
    $user = $this->getMockUserData();

    return view('courses.enroll.courseContent', [
        'course' => $course,
        'content' => $content,
        'user' => $user,
        'currentSection' => 0,
        'currentLesson' => 0,
        'navigation' => $this->getNavigation(0, 0, $content)
    ]);
}

// New method to show specific lesson
public function showLesson($courseId, $section, $lesson)
{
    $course = $this->getMockCourseData($courseId);
    $content = $this->getMockCourseContent($courseId);
    $user = $this->getMockUserData();

    return view('courses.enroll.courseContent', [
        'course' => $course,
        'content' => $content,
        'user' => $user,
        'currentSection' => (int)$section,
        'currentLesson' => (int)$lesson,
        'navigation' => $this->getNavigation((int)$section, (int)$lesson, $content)
    ]);
}

// New method to mark course as completed
public function completeCourse($courseId)
{
    $course = $this->getMockCourseData($courseId);
    $user = $this->getMockUserData();

    if(request()->has('name')) {
        $user['name'] = request()->input('name');
    }

    $certificate = [
        'user' => $user,
        'course' => $course,
        'enrollment_id' => 'ENR-' . uniqid(),
        'completion_details' => [
            'score' => rand(85, 100),
            'grade' => $this->calculateGrade(rand(85, 100)),
            'completed_at' => now()->format('Y-m-d H:i:s')
        ],
        'instructor' => [
            'name' => $course['instructor'],
            'title' => 'Senior Instructor'
        ],
        'institution' => [
            'name' => 'EduVerse Learning Platform',
            'seal' => 'https://via.placeholder.com/150?text=EduVerse+Seal',
            'signature' => null
        ],
        'certificate_info' => [
            'id' => 'CER-' . strtoupper(uniqid()),
            'issued_date' => now()->format('F j, Y'),
            'verification_code' => strtoupper(uniqid())
        ],
        'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' .
                    urlencode('https://eduverse.com/verify/' . uniqid())
    ];

    return view('courses.enroll.certificate', [
        'certificate' => $certificate,
        'share_url' => url('/certificate/' . $certificate['enrollment_id']),
        'courseId' => $courseId // Make sure to pass courseId separately
    ]);
}

private function calculateGrade($score)
{
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'F';
}

// Helper method to generate mock course content
private function getMockCourseContent($courseId)
{
    // Sample video URLs tailored to each course topic
    $topicVideos = [
        1 => [ // Web Development
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4'
        ],
        2 => [ // Data Science
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4'
        ],
        3 => [ // Digital Marketing
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/SubaruOutbackOnStreetAndDirt.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4',
            'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/VolkswagenGTIReview.mp4'
        ],
        4 => [ // Business Fundamentals
            'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4',
            'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_2mb.mp4',
            'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_5mb.mp4'
        ],
        5 => [ // UI/UX Design
            'https://sample-videos.com/video123/mp4/480/big_buck_bunny_480p_1mb.mp4',
            'https://sample-videos.com/video123/mp4/480/big_buck_bunny_480p_2mb.mp4',
            'https://sample-videos.com/video123/mp4/480/big_buck_bunny_480p_5mb.mp4'
        ],
        6 => [ // Flutter Development
            'https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_1mb.mp4',
            'https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_2mb.mp4',
            'https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_5mb.mp4'
        ]
    ];

    // Fallback sample videos
    $fallbackVideos = [
        'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
        'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4'
    ];


    $getVideoUrl = function($lessonIndex) use ($courseId, $topicVideos, $fallbackVideos) {
        if (isset($topicVideos[$courseId])) {
            $videos = $topicVideos[$courseId];
            return $videos[$lessonIndex % count($videos)] ?? $fallbackVideos[array_rand($fallbackVideos)];
        }
        return $fallbackVideos[array_rand($fallbackVideos)];
    };

    $mockContents = [
        1 => [ // Web Development
            'sections' => [
                [
                    'title' => 'HTML Fundamentals',
                    'lessons' => [
                        [
                            'title' => 'Introduction to HTML',
                            'duration' => '15 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'resources' => [
                                ['type' => 'pdf', 'title' => 'HTML Cheat Sheet'],
                                ['type' => 'link', 'title' => 'MDN HTML Documentation']
                            ],
                            'quiz' => [
                                'title' => 'HTML Basics Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What does HTML stand for?',
                                        'options' => [
                                            'Hyper Text Markup Language',
                                            'Hyperlinks and Text Markup Language',
                                            'Home Tool Markup Language'
                                        ],
                                        'correct' => 0,
                                        'explanation' => 'HTML stands for Hyper Text Markup Language.'
                                    ],
                                    [
                                        'question' => 'Which tag is used for the largest heading?',
                                        'options' => ['<h1>', '<h6>', '<heading>'],
                                        'correct' => 0,
                                        'explanation' => '<h1> is used for the main heading.'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'HTML Elements and Attributes',
                            'duration' => '20 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(1),
                            'quiz' => [
                                'title' => 'HTML Elements Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which element creates a line break?',
                                        'options' => ['<br>', '<lb>', '<break>'],
                                        'correct' => 0,
                                        'explanation' => '<br> creates a line break.'
                                    ],
                                    [
                                        'question' => 'Which attribute specifies an image source?',
                                        'options' => ['src', 'href', 'link'],
                                        'correct' => 0,
                                        'explanation' => 'The src attribute specifies the image source.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'CSS Styling',
                    'lessons' => [
                        [
                            'title' => 'CSS Basics',
                            'duration' => '25 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(2),
                            'quiz' => [
                                'title' => 'CSS Fundamentals Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which property changes text color?',
                                        'options' => ['color', 'text-color', 'font-color'],
                                        'correct' => 0,
                                        'explanation' => 'The "color" property sets text color.'
                                    ],
                                    [
                                        'question' => 'Which property changes the font size?',
                                        'options' => ['font-size', 'text-size', 'size'],
                                        'correct' => 0,
                                        'explanation' => 'The "font-size" property controls text size.'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'CSS Layouts',
                            'duration' => '30 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'CSS Layout Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which property enables Flexbox?',
                                        'options' => ['display: flex', 'display: grid', 'display: block'],
                                        'correct' => 0,
                                        'explanation' => 'display: flex enables Flexbox layout.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'Web Development Final Assessment',
                'passing_score' => 70,
                'questions' => [
                    [
                        'question' => 'What does CSS stand for?',
                        'options' => [
                            'Computer Style Sheets',
                            'Creative Style Sheets',
                            'Cascading Style Sheets'
                        ],
                        'correct' => 2,
                        'explanation' => 'CSS stands for Cascading Style Sheets.'
                    ],
                    [
                        'question' => 'Which HTML attribute is used for inline styles?',
                        'options' => ['style', 'class', 'font'],
                        'correct' => 0,
                        'explanation' => 'The "style" attribute is used for inline CSS.'
                    ]
                ]
            ]
        ],
        2 => [ // Data Science
            'sections' => [
                [
                    'title' => 'Python Basics',
                    'lessons' => [
                        [
                            'title' => 'Introduction to Python',
                            'duration' => '20 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'Python Basics Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which keyword defines a function?',
                                        'options' => ['func', 'def', 'function'],
                                        'correct' => 1,
                                        'explanation' => 'Python uses "def" to define functions.'
                                    ],
                                    [
                                        'question' => 'Which data type is mutable?',
                                        'options' => ['list', 'tuple', 'string'],
                                        'correct' => 0,
                                        'explanation' => 'Lists are mutable in Python.'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Python Data Structures',
                            'duration' => '25 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(1),
                            'quiz' => [
                                'title' => 'Data Structures Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which is NOT a Python data structure?',
                                        'options' => ['array', 'dictionary', 'queue'],
                                        'correct' => 2,
                                        'explanation' => 'Queue is not a built-in data structure.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'Data Analysis',
                    'lessons' => [
                        [
                            'title' => 'Pandas Basics',
                            'duration' => '30 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(2),
                            'quiz' => [
                                'title' => 'Pandas Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What is the primary Pandas data structure?',
                                        'options' => ['Series', 'DataFrame', 'Array'],
                                        'correct' => 1,
                                        'explanation' => 'DataFrame is the primary Pandas structure.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'Data Science Final Assessment',
                'passing_score' => 75,
                'questions' => [
                    [
                        'question' => 'Which library is used for data manipulation?',
                        'options' => ['NumPy', 'Pandas', 'Matplotlib'],
                        'correct' => 1,
                        'explanation' => 'Pandas is used for data manipulation.'
                    ],
                    [
                        'question' => 'What does CSV stand for?',
                        'options' => [
                            'Comma Separated Values',
                            'Columnar Storage Values',
                            'Computer System Variables'
                        ],
                        'correct' => 0,
                        'explanation' => 'CSV stands for Comma Separated Values.'
                    ]
                ]
            ]
        ],
        // ... [similar structure for other courses with their own quizzes]
        3 => [ // Digital Marketing
            'sections' => [
                [
                    'title' => 'Marketing Fundamentals',
                    'lessons' => [
                        [
                            'title' => 'SEO Basics',
                            'duration' => '18 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'SEO Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What does SEO stand for?',
                                        'options' => [
                                            'Search Engine Optimization',
                                            'Social Engagement Optimization',
                                            'Site Enhancement Operations'
                                        ],
                                        'correct' => 0,
                                        'explanation' => 'SEO stands for Search Engine Optimization.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        4 => [ // Business Fundamentals
            'sections' => [
                [
                    'title' => 'Business Concepts',
                    'lessons' => [
                        [
                            'title' => 'Finance Basics',
                            'duration' => '22 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'Finance Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What does ROI stand for?',
                                        'options' => [
                                            'Return on Investment',
                                            'Rate of Interest',
                                            'Revenue on Inventory'
                                        ],
                                        'correct' => 0,
                                        'explanation' => 'ROI stands for Return on Investment.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        5 => [ // UI/UX Design
            'sections' => [
                [
                    'title' => 'Design Principles',
                    'lessons' => [
                        [
                            'title' => 'Color Theory',
                            'duration' => '15 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'Design Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which color represents trust?',
                                        'options' => ['Red', 'Blue', 'Yellow'],
                                        'correct' => 1,
                                        'explanation' => 'Blue is commonly associated with trust.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        6 => [ // Flutter Development
            'sections' => [
                [
                    'title' => 'Mobile App Basics',
                    'lessons' => [
                        [
                            'title' => 'Flutter Introduction',
                            'duration' => '20 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'quiz' => [
                                'title' => 'Flutter Basics Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What language does Flutter use?',
                                        'options' => ['JavaScript', 'Dart', 'Python'],
                                        'correct' => 1,
                                        'explanation' => 'Flutter uses the Dart programming language.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    return $mockContents[$courseId] ?? [
        'sections' => [
            [
                'title' => 'Sample Section',
                'lessons' => [
                    [
                        'title' => 'Sample Lesson',
                        'duration' => '10 min',
                        'type' => 'video',
                        'video_url' => $fallbackVideos[0],
                        'quiz' => [
                            'title' => 'Sample Quiz',
                            'questions' => [
                                [
                                    'question' => 'Sample question?',
                                    'options' => ['Option 1', 'Option 2', 'Option 3'],
                                    'correct' => 0,
                                    'explanation' => 'Sample explanation'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];
}

// Helper method to get navigation data
private function getNavigation($currentSection, $currentLesson, $content)
{
    $prev = null;
    $next = null;

    // Calculate previous lesson
    if ($currentLesson > 0) {
        $prev = ['section' => $currentSection, 'lesson' => $currentLesson - 1];
    } elseif ($currentSection > 0) {
        $prevSection = $currentSection - 1;
        $prevLesson = count($content['sections'][$prevSection]['lessons']) - 1;
        $prev = ['section' => $prevSection, 'lesson' => $prevLesson];
    }

    // Calculate next lesson
    if ($currentLesson < count($content['sections'][$currentSection]['lessons']) - 1) {
        $next = ['section' => $currentSection, 'lesson' => $currentLesson + 1];
    } elseif ($currentSection < count($content['sections']) - 1) {
        $next = ['section' => $currentSection + 1, 'lesson' => 0];
    }

    return [
        'prev' => $prev,
        'next' => $next
    ];
}

// Helper method to get mock user data
private function getMockUserData()
{
    return [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
    ];
}
}

