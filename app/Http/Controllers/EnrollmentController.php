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

        $request->session()->put('enrollment_data', [
            'course_id' => $courseId,
            'verified_at' => now(),
            'selected_package' => $request->input('package', 'free')
        ]);

        return redirect()->route('enroll.success', $courseId);
    }

    public function complete(Request $request, $courseId)
    {
        if (!$request->session()->has('enrollment_data')) {
            return redirect()->route('enroll.courseContent', ['courseId' => $courseId]);
        }

        $course = $this->getMockCourseData($courseId);
        return view('courses.enroll.complete', compact('course'));

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

    // Show enrollment success page
    public function success(Request $request, $courseId)
    {
        // Get package from either URL parameter or session
        $package = $request->input('package') ??
                  ($request->session()->get('enrollment_data')['selected_package'] ?? 'free');

        $course = $this->getMockCourseData($courseId);

        $successData = [
            'course' => $course,
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ],
            'enrollment' => [
                'id' => uniqid(),
                'package' => $package,
                'completed' => false
            ],
            'has_paid_options' => $course['has_paid_options'] // Add this line
        ];

        return view('courses.enroll.success', compact('successData'));
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
            'category' => "Marketing",
            'description' => "SEO, Social Media, PPC, Email Marketing, Content Marketing, Analytics & More!",
            'image' => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            'rating' => 4.7,
            'students_count' => 6543,
            'difficulty' => "beginner",
            'is_free' => true,
            'has_paid_options' => false,
            'price' => 0,
            'standard_price' => 29.99,
            'premium_price' => 59.99
        ],
        4 => [
            'id' => 4,
            'title' => "Business Fundamentals",
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
            'category' => "Design",
            'description' => "Master user interface and user experience design principles. Learn Figma, Adobe XD.",
            'image' => "https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80",
            'rating' => 4.6,
            'students_count' => 5432,
            'difficulty' => "intermediate",
            'is_free' => true,
            'has_paid_options' => true,
            'price' => 0,
            'standard_price' => 39.99,
            'premium_price' => 79.99
        ],
        6 => [
            'id' => 6,
            'title' => "Flutter Mobile App Development",
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
        'category' => "General",
        'description' => "This is a sample course description",
        'image' => "https://images.unsplash.com/photo-1501504905252-473c47e087f8",
        'rating' => 4.0,
        'students_count' => 1000,
        'difficulty' => "beginner",
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
    // In a real app, you'd fetch this from database
    $enrollment = [
        'id' => $enrollmentId,
        'user' => [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ],
        'course' => $this->getMockCourseData(request()->input('course_id')),
        'completed_at' => now()->format('M d, Y'),
        'score' => rand(85, 100),
        'certificate_id' => 'CER-' . rand(1000, 9999)
    ];

    return view('certificate.show', compact('enrollment'));
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
}

