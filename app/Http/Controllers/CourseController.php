<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('show_published_courses');
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $courses = null;
        if ($user) {
            $courses = $user->courses()->with(['categories', 'user', 'modules'])->latest()->paginate(10)->onEachSide(2);
            foreach ($courses as $course) {
                $course->change_status();
            }
        }

        return view('admin.courses', compact('courses'));
    }
    public function create_course(Request $request)
    {
        $category = null;
        $authUser = User::find(Auth::user()->id);

        // basic validation needed by the courses table 

        $request->validate([
            'title' => 'required',
            'category' => ['required', Rule::in('Web Development', 'Data Science', 'Design', 'Business')],
            'difficulty' => [Rule::in('Intermediate', 'Beginner', 'Advanced')],
            'duration_weeks' => ['numeric'],
            'credit_hours' => ['required', 'numeric'],
            'description' => 'required',
            'final_exam_weight' => 'required|numeric',
            'number_of_modules' => 'required|numeric|min:1',
        ]);


        $newCourse = $authUser->courses()->create([
            'title' => $request->title,
            'duration' => $request->duration_weeks,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'difficulty' => $request->difficulty,
            'credit_hours' => $request->credit_hours,
            'final_exam_weight' => $request->final_exam_weight,
            'number_of_modules' => $request->number_of_modules
        ]);

        try {
            $category = Category::where('category_name', $request->category)->firstOrFail();
            $newCourse->categories()->attach($category->id);
        } catch (ModelNotFoundException $e) {
            $category = Category::create(['category_name' => $request->category]);
            $newCourse->categories()->attach($category->id);
        }

        return back();
    }

    public function show_published_courses()
    {
        $courses = Course::latest()->paginate(10)->onEachSide(2);
        $user = User::find(Auth::user()->id);
        return view('learner.published-courses', compact('courses', 'user'));
    }

    public function delete_course(Course $course)
    {
        $course->delete();
        return back();
    }

    public function course_details(Course $course)
    {
        // $questions = $course->quiz_questions;
        $questions = $course->quiz_questions->load('option');
        $course = $course->load('modules', 'categories');

        return response()->json(['course' => $course, 'questions' => $questions]);
    }

    public function enrolled_course_content(Course $course)
    {
        $modules = $course->modules;
        $user = User::find(Auth::user()->id);
        $enrollment = Enrollment::where('enrolled_by', $user->id)->where('course_id', $course->id)->first();
        $currentModule = $enrollment->get_current_module($course->id);
        return view('learner.enroll.course-content', compact('course', 'modules', 'enrollment', 'currentModule'));
    }

    public function next_module(Course $course, $moduleNumber)
    {
        $modules = $course->modules;
        $user = User::find(Auth::user()->id);
        $enrollment = Enrollment::where('enrolled_by', $user->id)->where('course_id', $course->id)->first();

        $currentModule = $enrollment->next_module($course->id, $moduleNumber + 1);
        return view('learner.enroll.course-content', compact('course', 'modules', 'enrollment', 'currentModule'));
    }
    public function previous_module(Course $course, $moduleNumber)
    {
        $modules = $course->modules;
        $user = User::find(Auth::user()->id);
        $enrollment = Enrollment::where('enrolled_by', $user->id)->where('course_id', $course->id)->first();

        $currentModule = $enrollment->previous_module($course->id, $moduleNumber - 1);
        return view('learner.enroll.course-content', compact('course', 'modules', 'enrollment', 'currentModule'));
    }
}
