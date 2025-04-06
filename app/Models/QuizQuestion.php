<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['module_id', 'question_text'];

    public function option()
    {
        return $this->hasOne(QuizOption::class);
    }

    public function quiz_attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
