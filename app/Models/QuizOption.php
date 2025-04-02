<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    //

    protected $fillable = [
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'quiz_question_id',
        'correct_option',
    ];

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
