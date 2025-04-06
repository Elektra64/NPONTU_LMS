<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\QuizQuestion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Course $course)
    {
        return view('learner.enroll.verify', compact('course'));
    }

    public function verify(Request $request, Course $course)
    {

        $request->validate([
            'puzzle_solution' => 'required'
        ]);


        if (!$this->verify_puzzle($request->puzzle_solution)) {
            return back()->with('error', 'Puzzle verification failed. Please try again.');
        }
        return redirect()->route('enroll', $course->id);
    }

    private function verify_puzzle($solution)
    {
        $correctSequence = ['A', 'B', 'C', 'D', 'E', 'F'];
        $value = false;

        $data = json_decode($solution);
        if (count($data) == 6) {
            for ($i = 0; $i < count($correctSequence); $i++) {
                if ($correctSequence[$i] === $data[$i]) {
                    $value = true;
                    continue;
                } else {
                    return false;
                }
            }
        }
        return $value;
    }

    public function enroll(Course $course)
    {
        return view('learner.enroll.success', compact('course'));
    }

    public function validate_enrollment(Request $request, Course $course)
    {
        $request->validate([
            'terms' => 'required|accepted'
        ]);

        // add student to enrollment table
        $course->enrollments()->create([
            'enrolled_by' => Auth::user()->id,
        ]);

        // redirect to course content

        return redirect(route('enrolled_course_content', $course->id));
    }

    public function submit_quiz(Request $request, QuizQuestion $quizQuestion, Enrollment $enrollment)
    {
        $request->validate([
            'option' => 'required'
        ]);
        if ($quizQuestion->option->correct_option == $request->option) {
            $quizQuestion->quiz_attempts()->create([
                'enrollment_id' => $enrollment->id,
                'score' => 100,
                'time_taken' => 1
            ]);
        }
        $quizQuestion->quiz_attempts()->create([
            'enrollment_id' => $enrollment->id,
            'score' => 0,
            'time_taken' => 1
        ]);

        return back();
    }
}

