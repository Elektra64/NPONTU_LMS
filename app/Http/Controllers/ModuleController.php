<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, Course $course)
    {

        $this->validateRequest($request);

        for ($i = 0; $i < count($request->module_title); $i++) {
            $module = $this->create_module($request->module_content[$i], $request->module_title[$i], $request->module_number[$i], $course);

            for ($j = 0; $j < count($request->question_text); $j++) {
                $this->create_module_quiz($request->question_text[$j], $request->option_a[$j], $request->option_b[$j], $request->option_c[$j], $request->option_d[$j], $request->correct_option[$j], $module);
            }
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

        return $newModule;
    }

    public function create_module_quiz($question, $a, $b, $c, $d, $correct_option, $module)
    {
        $newQuizQuestion = $module->quiz_questions()->create(
            ['question_text' => $question]
        );

        $newQuizQuestion->option()->create([
            'option_a' => $a,
            'option_b' => $b,
            'option_c' => $c,
            'option_d' => $d,
            'correct_option' => $correct_option,
        ]);
    }

    public function validateRequest($request)
    {
        $request->validate([
            'module_content' => 'bail|required|array|min:1',
            'module_number' => 'bail|required|array|min:1',
            'module_title.*' => 'bail|required',
            'module_content.*' => 'bail|required',
            'module_number.*' => 'bail|required|numeric',
            'question_text' => 'bail|required|array|min:1',
            'option_a' => 'bail|required|array|min:1',
            'option_b' => 'bail|required|array|min:1',
            'option_c' => 'bail|required|array|min:1',
            'option_d' => 'bail|required|array|min:1',
            'correct_option' => 'bail|required|array|min:1',
            'question_text.*' => 'bail|required',
            'option_a.*' => 'bail|required',
            'option_b.*' => 'bail|required',
            'option_c.*' => 'bail|required',
            'option_d.*' => 'bail|required',
            'correct_option.*' => 'bail|required',
        ]);
    }

    public function delete(Module $module)
    {
        $module->delete();
        return back();
    }
}
