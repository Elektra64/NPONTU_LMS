<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Show enrollment verification page
    public function show($courseId)
    {
        $course = $this->getMockCourseData($courseId);
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

        return redirect()->route('enroll.complete', $courseId);
    }

    public function complete(Request $request, $courseId)
    {
        if (!$request->session()->has('enrollment_data')) {
            return redirect()->route('enroll.show', $courseId);
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
            return redirect()->route('enroll.show', $courseId);
        }

        // Clear session data
        $request->session()->forget('enrollment_data');

        return redirect()->route('enroll.success', [
            'id' => $courseId,
            'package' => $validated['package']
        ]);
    }

    // Show enrollment success page
    public function success(Request $request, $courseId)
    {
        $package = $request->input('package', 'free');

        $successData = [
            'course' => [
                'id' => $courseId,
                'title' => $this->getMockCourseData($courseId)['title'],
                'isFree' => $package === 'free',
                'package' => $package
            ],
            'user' => [
                'name' => 'John Doe', // Mock user data
                'email' => 'john@example.com'
            ]
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
                'title' => 'Web Development Bootcamp',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'description' => 'Master HTML, CSS, JavaScript, React, Node.js and more...',
                'rating' => 4.9,
                'students_count' => 12345,
                'is_free' => true,
                'has_paid_options' => true,
                'price' => 49.99,
                'standard_price' => 49.99,
                'premium_price' => 99.99
            ],
            2 => [
                'id' => 2,
                'title' => 'Graphic Design Masterclass',
                'image' => 'https://images.unsplash.com/photo-1541462608143-67571c6738dd',
                'description' => 'Learn Photoshop, Illustrator, and design principles',
                'rating' => 4.7,
                'students_count' => 8765,
                'is_free' => false,
                'has_paid_options' => true,
                'price' => 79.99,
                'standard_price' => 79.99,
                'premium_price' => 149.99
            ]
        ];

        // Default course if ID not found
        $defaultCourse = [
            'id' => $courseId,
            'title' => 'Sample Course',
            'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8',
            'description' => 'This is a sample course description',
            'rating' => 4.5,
            'students_count' => 5000,
            'is_free' => true,
            'has_paid_options' => false,
            'price' => 0,
            'standard_price' => 29.99,
            'premium_price' => 59.99
        ];

        return $mockCourses[$courseId] ?? $defaultCourse;
    }

}


