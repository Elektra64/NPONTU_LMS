<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'quiz_question_id',
        'correct_option',
    ];

    public function quiz_question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
