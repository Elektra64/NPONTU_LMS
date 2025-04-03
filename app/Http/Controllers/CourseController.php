<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
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
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $courses = null;
        if ($user) {
            $courses = $user->courses()->with(['categories', 'user', 'modules'])->latest()->paginate(5)->onEachSide(2);
            foreach ($courses as $course) {
                $course->change_status();
            }
        }

        return view('courses', compact('courses'));
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
            'number_of_modules' => 'required|numeric',
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

    public function published_courses()
    {
        return view('learner.published-courses');
    }
}
