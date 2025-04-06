<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    //
    protected $fillable = [
        'enrollment_id',
        'quiz_question_id',
        'score',
        'time_taken'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class)->latest();
    }
}
