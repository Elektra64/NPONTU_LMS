<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
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
            ],
            7=> [
                'id'=> 7,
                'title'=> 'Introduction to Artificial Intelligence',
                'instructor'=> 'John Doe',
                'category'=> 'Technology',
                'description'=> 'Learn the basics of artificial intelligence, machine learning, and deep learning.',
                'image'=> 'https://images.unsplash.com/photo-1558640190-256970210c74',
                'rating'=> 4.5,
                'students_count'=> 9876,
                'difficulty'=> 'intermediate',
                'badge'=> 'NEW',
                'badgeColor'=> 'bg-blue-500 text-white',
                'is_free'=> false,
                'has_paid_options'=> true,
                'price'=> 49.99,
               'standard_price'=> 49.99,
               'premium_price'=> 87.99,
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

//get popular course......//
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

public function showLandingPage()
{
    $popularCourses = $this->getPopularCourses(6); // Get 6 popular courses
    return view('landing', compact('popularCourses'));
}

//............... getMockCourseContent......................//
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
        ],
        7=> [ 'https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_1mb.mp4',
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
                    'description' => 'Learn the building blocks of web development with HTML',
                    'lessons' => [
                        [
                            'title' => 'Introduction to HTML',
                            'duration' => '15 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'content' => [
                                'overview' => 'HTML (HyperText Markup Language) is the standard markup language for creating web pages.',
                                'explanations' => [
                                    [
                                        'title' => 'HTML Structure',
                                        'content' => 'Every HTML document has a basic structure with <!DOCTYPE>, <html>, <head>, and <body> tags.'
                                    ],
                                    [
                                        'title' => 'Common Elements',
                                        'content' => 'Learn about common elements like <h1>-<h6> for headings, <p> for paragraphs, and <a> for links.'
                                    ]
                                ],
                                'methods' => [
                                    [
                                        'name' => 'Creating a Basic Page',
                                        'steps' => [
                                            '1. Start with the DOCTYPE declaration',
                                            '2. Add the HTML root element',
                                            '3. Include head and body sections',
                                            '4. Add content elements'
                                        ]
                                    ]
                                ]
                            ],
                            'resources' => [
                                ['type' => 'pdf', 'title' => 'HTML Cheat Sheet', 'url' => '#'],
                                ['type' => 'link', 'title' => 'MDN HTML Documentation', 'url' => 'https://developer.mozilla.org/en-US/docs/Web/HTML']
                            ],
                            'quiz' => [
                                'title' => 'HTML Basics Quiz',
                                'instructions' => 'Test your understanding of basic HTML concepts',
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
                                    ],
                                    [
                                        'question' => 'Which tag creates a line break?',
                                        'options' => ['<br>', '<lb>', '<break>'],
                                        'correct' => 0,
                                        'explanation' => '<br> creates a line break in HTML.'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'HTML Forms and Input',
                            'duration' => '20 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(1),
                            'content' => [
                                'overview' => 'Forms allow users to interact with your website by submitting data.',
                                'explanations' => [
                                    [
                                        'title' => 'Form Structure',
                                        'content' => 'Forms are created with the <form> tag and contain various input elements.'
                                    ]
                                ]
                            ],
                            'quiz' => [
                                'title' => 'HTML Forms Quiz',
                                'questions' => [
                                    [
                                        'question' => 'Which tag creates a form?',
                                        'options' => ['<form>', '<input>', '<submit>'],
                                        'correct' => 0,
                                        'explanation' => 'The <form> tag creates a form container.'
                                    ],
                                    [
                                        'question' => 'Which input type creates a checkbox?',
                                        'options' => ['type="checkbox"', 'type="check"', 'type="radio"'],
                                        'correct' => 0,
                                        'explanation' => 'type="checkbox" creates a checkbox input.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'CSS Styling',
                    'description' => 'Learn how to style your web pages with CSS',
                    'lessons' => [
                        [
                            'title' => 'CSS Basics',
                            'duration' => '25 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(2),
                            'content' => [
                                'overview' => 'CSS (Cascading Style Sheets) is used to style HTML elements.',
                                'explanations' => [
                                    [
                                        'title' => 'CSS Syntax',
                                        'content' => 'CSS rules consist of selectors and declarations in curly braces.'
                                    ]
                                ]
                            ],
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
                                    ],
                                    [
                                        'question' => 'How do you select an element with id="header"?',
                                        'options' => ['#header', '.header', 'header'],
                                        'correct' => 0,
                                        'explanation' => 'The # symbol selects elements by id.'
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
                    ],
                    [
                        'question' => 'Which CSS property controls element spacing?',
                        'options' => ['margin', 'color', 'font-family'],
                        'correct' => 0,
                        'explanation' => 'Margin controls spacing around elements.'
                    ]
                ]
            ]
        ],
        2 => [ // Data Science
            'sections' => [
                [
                    'title' => 'Python Basics',
                    'description' => 'Learn the fundamentals of Python programming',
                    'lessons' => [
                        [
                            'title' => 'Introduction to Python',
                            'duration' => '20 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(0),
                            'content' => [
                                'overview' => 'Python is a versatile programming language popular for data science.',
                                'explanations' => [
                                    [
                                        'title' => 'Python Syntax',
                                        'content' => 'Python uses indentation to define code blocks instead of curly braces.'
                                    ]
                                ]
                            ],
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
                                    ],
                                    [
                                        'question' => 'How do you create a comment?',
                                        'options' => ['# Comment', '// Comment', '<!-- Comment -->'],
                                        'correct' => 0,
                                        'explanation' => 'Python uses # for comments.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'Data Analysis',
                    'description' => 'Learn how to analyze data with Python',
                    'lessons' => [
                        [
                            'title' => 'Pandas Basics',
                            'duration' => '30 min',
                            'type' => 'video',
                            'video_url' => $getVideoUrl(1),
                            'quiz' => [
                                'title' => 'Pandas Quiz',
                                'questions' => [
                                    [
                                        'question' => 'What is the primary Pandas data structure?',
                                        'options' => ['Series', 'DataFrame', 'Array'],
                                        'correct' => 1,
                                        'explanation' => 'DataFrame is the primary Pandas structure.'
                                    ],
                                    [
                                        'question' => 'How do you read a CSV file?',
                                        'options' => ['pd.read_csv()', 'pd.open_csv()', 'pd.load_csv()'],
                                        'correct' => 0,
                                        'explanation' => 'Use pd.read_csv() to read CSV files.'
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
                    ],
                    [
                        'question' => 'Which method displays DataFrame summary?',
                        'options' => ['describe()', 'summary()', 'info()'],
                        'correct' => 0,
                        'explanation' => 'describe() shows statistical summary.'
                    ]
                ]
            ]
        ],
        3 => [ // Digital Marketing
            'sections' => [
                [
                    'title' => 'Marketing Fundamentals',
                    'description' => 'Core concepts of digital marketing',
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
                                    ],
                                    [
                                        'question' => 'Which tag is most important for SEO?',
                                        'options' => ['<title>', '<div>', '<span>'],
                                        'correct' => 0,
                                        'explanation' => 'The <title> tag is crucial for SEO.'
                                    ],
                                    [
                                        'question' => 'What improves page ranking?',
                                        'options' => ['Quality content', 'Hidden text', 'Keyword stuffing'],
                                        'correct' => 0,
                                        'explanation' => 'Quality content improves rankings.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'Digital Marketing Final Assessment',
                'passing_score' => 70,
                'questions' => [
                    [
                        'question' => 'Which platform is best for B2B marketing?',
                        'options' => ['LinkedIn', 'Instagram', 'TikTok'],
                        'correct' => 0,
                        'explanation' => 'LinkedIn is best for B2B.'
                    ],
                    [
                        'question' => 'What does CTR stand for?',
                        'options' => [
                            'Click-Through Rate',
                            'Customer Transaction Ratio',
                            'Content Tracking Report'
                        ],
                        'correct' => 0,
                        'explanation' => 'CTR means Click-Through Rate.'
                    ],
                    [
                        'question' => 'Which metric measures engagement?',
                        'options' => ['Bounce Rate', 'Server Uptime', 'DNS Lookup'],
                        'correct' => 0,
                        'explanation' => 'Bounce Rate measures engagement.'
                    ]
                ]
            ]
        ],
        4 => [ // Business Fundamentals
            'sections' => [
                [
                    'title' => 'Business Concepts',
                    'description' => 'Essential business principles and terminology',
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
                                    ],
                                    [
                                        'question' => 'Which financial statement shows profitability?',
                                        'options' => ['Income Statement', 'Balance Sheet', 'Cash Flow'],
                                        'correct' => 0,
                                        'explanation' => 'Income Statement shows profitability.'
                                    ],
                                    [
                                        'question' => 'What is a companys equity?',
                                        'options' => ['Assets - Liabilities', 'Revenue - Expenses', 'Cash - Debt'],
                                        'correct' => 0,
                                        'explanation' => 'Equity = Assets - Liabilities.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'Business Fundamentals Final Assessment',
                'passing_score' => 75,
                'questions' => [
                    [
                        'question' => 'What is SWOT analysis?',
                        'options' => [
                            'Strengths, Weaknesses, Opportunities, Threats',
                            'Sales, Workforce, Operations, Technology',
                            'Strategy, Workflow, Objectives, Tactics'
                        ],
                        'correct' => 0,
                        'explanation' => 'SWOT = Strengths, Weaknesses, Opportunities, Threats.'
                    ],
                    [
                        'question' => 'Which is a current asset?',
                        'options' => ['Inventory', 'Building', 'Patent'],
                        'correct' => 0,
                        'explanation' => 'Inventory is a current asset.'
                    ],
                    [
                        'question' => 'What does B2C mean?',
                                        'options' => [
                                            'Business to Consumer',
                                            'Business to Company',
                                            'Buyer to Customer'
                                        ],
                                        'correct' => 0,
                                        'explanation' => 'B2C means Business to Consumer.'
                                    ]
                                ]
                            ]
                        ],
        5 => [ // UI/UX Design
            'sections' => [
                [
                    'title' => 'Design Principles',
                    'description' => 'Fundamentals of user interface and experience design',
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
                                    ],
                                    [
                                        'question' => 'What is the ideal line length?',
                                        'options' => ['50-60 characters', '20-30 characters', '100+ characters'],
                                        'correct' => 0,
                                        'explanation' => '50-60 characters is optimal for readability.'
                                    ],
                                    [
                                        'question' => 'What does UX stand for?',
                                        'options' => ['User Experience', 'User Examination', 'Ultra Experience'],
                                        'correct' => 0,
                                        'explanation' => 'UX means User Experience.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'UI/UX Design Final Assessment',
                'passing_score' => 70,
                'questions' => [
                    [
                        'question' => 'Which is NOT a design principle?',
                        'options' => ['Contrast', 'Alignment', 'Compression'],
                        'correct' => 2,
                        'explanation' => 'Compression is not a design principle.'
                    ],
                    [
                        'question' => 'What does F-shaped pattern refer to?',
                                        'options' => [
                                            'How users scan content',
                                            'Font styling technique',
                                            'Color gradient pattern'
                                        ],
                                        'correct' => 0,
                                        'explanation' => 'F-shaped pattern describes content scanning behavior.'
                                    ],
                                    [
                                        'question' => 'Which tool is for prototyping?',
                                        'options' => ['Figma', 'Photoshop', 'Excel'],
                                        'correct' => 0,
                                        'explanation' => 'Figma is a prototyping tool.'
                                    ]
                                ]
                            ]
                        ],
        6 => [ // Flutter Development
            'sections' => [
                [
                    'title' => 'Mobile App Basics',
                    'description' => 'Introduction to Flutter and mobile development',
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
                                    ],
                                    [
                                        'question' => 'What is a Widget in Flutter?',
                                        'options' => ['UI component', 'Database table', 'Network request'],
                                        'correct' => 0,
                                        'explanation' => 'Widgets are UI components in Flutter.'
                                    ],
                                    [
                                        'question' => 'Which command creates a new app?',
                                        'options' => ['flutter create', 'flutter new', 'flutter start'],
                                        'correct' => 0,
                                        'explanation' => 'Use "flutter create" to start a new project.'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'final_quiz' => [
                'title' => 'Flutter Development Final Assessment',
                'passing_score' => 75,
                'questions' => [
                    [
                        'question' => 'What is Flutters main advantage?',
                        'options' => [
                            'Cross-platform development',
                            'Only works on Android',
                            'No programming needed'
                        ],
                        'correct' => 0,
                        'explanation' => 'Flutter allows cross-platform development.'
                    ],
                    [
                        'question' => 'Which widget is for layout?',
                        'options' => ['Column', 'Text', 'Icon'],
                        'correct' => 0,
                        'explanation' => 'Column is a layout widget.'
                    ],
                    [
                        'question' => 'What is hot reload?',
                        'options' => [
                            'Instant UI updates',
                            'Device overheating',
                            'Network reconnection'
                        ],
                        'correct' => 0,
                        'explanation' => 'Hot reload shows UI changes instantly.'
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
                                    'question' => 'Sample question 1?',
                                    'options' => ['Option 1', 'Option 2', 'Option 3'],
                                    'correct' => 0,
                                    'explanation' => 'Sample explanation 1'
                                ],
                                [
                                    'question' => 'Sample question 2?',
                                    'options' => ['Option A', 'Option B', 'Option C'],
                                    'correct' => 1,
                                    'explanation' => 'Sample explanation 2'
                                ],
                                [
                                    'question' => 'Sample question 3?',
                                    'options' => ['Yes', 'No', 'Maybe'],
                                    'correct' => 2,
                                    'explanation' => 'Sample explanation 3'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'final_quiz' => [
            'title' => 'Sample Final Quiz',
            'passing_score' => 70,
            'questions' => [
                [
                    'question' => 'Final question 1?',
                    'options' => ['Choice 1', 'Choice 2', 'Choice 3'],
                    'correct' => 0,
                    'explanation' => 'Final explanation 1'
                ],
                [
                    'question' => 'Final question 2?',
                    'options' => ['Answer A', 'Answer B', 'Answer C'],
                    'correct' => 1,
                    'explanation' => 'Final explanation 2'
                ],
                [
                    'question' => 'Final question 3?',
                    'options' => ['True', 'False', 'Depends'],
                    'correct' => 2,
                    'explanation' => 'Final explanation 3'
                ]
            ]
        ]
    ];
}


//...........Show Lesson methods here........//!SECTION
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

//..........navigation methods........//!SECTION
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

//.........getMockUserData..........//!SECTION
private function getMockUserData()
{
    return [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
    ];
}

// This method is used to preview a course before enrollment
public function previewCourse($courseId)
{
    $course = $this->getMockCourseData($courseId);
    $content = $this->getMockCourseContent($courseId);
    
    return view('courses.preview', [
        'course' => $course,
        'content' => $content
    ]);
}
}
