<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'title',
        'content',
        'module_number',
        'course_id'
    ];



    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function quiz_questions()
    {
        return $this->hasMany(QuizQuestion::class)->latest();
    }
}
