<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, Course $course)
    {

        if (count($request->module_title)) {
            $request->validate([
                'module_content' => 'bail|required|array|min:1',
                'module_number' => 'bail|required|array|min:1',
                'module_title.*' => 'bail|required',
                'module_content.*' => 'bail|required',
                'module_number.*' => 'bail|required|numeric',
            ]);

            for ($i = 0; $i < count($request->module_title); $i++) {
                $this->create_module($request->module_content[$i], $request->module_title[$i], $request->module_number[$i], $course);
            }
        } else {
            $request->validate([
                'module_title' => 'bail|required',
                'module_content' => 'bail|required',
                'module_number' => 'bail|required|numeric',
            ]);

            $this->create_module($request->module_content, $request->title, $request->number, $course);
        }
        return back();
    }

    public function create_module($content, $title, $number, $course)
    {
        $newModule =  $course->modules()->create([
            'content' => $content,
            'title' => $title,
            'module_number' => $number,
        ]);

        // return $newModule;
    }

    public function create_module_quiz($question, $a, $b, $c, $d, $correct_option, $module)
    {
        $newQuizQuestion = $module->quiz_questions()->create(
            ['question_text' => $question]
        );

        $newQuizQuestion->options()->create([
            'option_a' => $a,
            'option_b' => $b,
            'option_c' => $c,
            'option_d' => $d,
            'correct_option' => $correct_option,
        ]);
    }
}
