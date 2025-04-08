<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Show enrollment verification page
    public function show($courseId)
    {
        $course = app(CourseController::class)->getMockCourseData($courseId);
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
        $course = app(CourseController::class)->getMockCourseData($courseId);

        $request->session()->put('enrollment_data', [
            'course_id' => $courseId,
            'course_data' => $course,
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
            'course' => $enrollmentData['course_data'],
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

        // Create enrollment record
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

    // Shows verification page
    public function showVerifyPage($courseId)
    {
        $course = app(CourseController::class)->getMockCourseData($courseId);
        if (!$course) {
            abort(404, 'Course not found');
        }
        return view('courses.enroll.verify', compact('course'));
    }

    // Certificate methods
    public function showCertificate($enrollmentId)
    {
        $courseId = request()->input('course_id') ?? 1;
        $certificate = [
            'user' => [
                'name' => request()->input('student_name', 'John Doe'),
                'email' => 'john@example.com',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
            ],
            'course' => app(CourseController::class)->getMockCourseData($courseId),
            'enrollment_id' => $enrollmentId,
            'completion_details' => [
                'score' => rand(85, 100),
                'grade' => $this->calculateGrade(rand(85, 100)),
                'completed_at' => now()->format('Y-m-d H:i:s')
            ],
            'instructor' => [
                'name' => app(CourseController::class)->getMockCourseData($courseId)['instructor'],
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
        return response()->json([
            'success' => true,
            'download_url' => '/certificates/download/' . $enrollmentId
        ]);
    }

    public function completeCourse($courseId)
    {
        $course = app(CourseController::class)->getMockCourseData($courseId);
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
            'courseId' => $courseId
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

    private function getMockUserData()
    {
        return [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
        ];
    }

    
}
