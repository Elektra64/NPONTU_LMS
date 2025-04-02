<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['module_id', 'question_text'];

    public function options()
    {
        return $this->hasMany(QuizOption::class);
    }
}
