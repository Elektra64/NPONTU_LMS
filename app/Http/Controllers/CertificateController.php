<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Course;

class CertificateController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id'
        ]);

        $user = User::find($request->user_id);
        $course = Course::find($request->course_id);

        $pdf = Pdf::loadView('certificate', [
            'name' => $user->name,
            'course' => $course->title
        ]);

        return $pdf->download("certificate_{$user->id}_{$course->id}.pdf");
    }
}

