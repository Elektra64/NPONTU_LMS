<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Course;

class CertificateController extends Controller
{
    public function generate($user_id, $course_id)
    {
        $user = User::findOrFail($user_id);
        $course = Course::findOrFail($course_id);

        return view('certificateTemplate', [
            'name' => $user->name,
            'course' => $course->title
        ]);
    }

}

