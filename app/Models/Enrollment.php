<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //
    protected $fillable = [
        'enrolled_by',
        'course_id',
        'progress',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'enrolled_by')->latest();
    }
    public function course()
    {
        return $this->belongsTo(Course::class)->latest();
    }

    public function get_current_module($id)
    {
        $module = match ($this->progress) {
            0 => Module::where('module_number', 1)->where('course_id', $id)->first(),
            default => Module::where('module_number', $this->progress)->where('course_id', $id)->first(),
        };
        return $module;
    }
    public function next_module($id, $moduleNumber)
    {
        $module = Module::where('module_number', $moduleNumber)->where('course_id', $id)->first();
        if ($this->progress <= $moduleNumber) {
            $this->progress = ++$this->progress;
            $this->save();
        }
        return $module;
    }

    public function previous_module($id, $moduleNumber)
    {
        $module = Module::where('module_number', $moduleNumber)->where('course_id', $id)->first();
        return $module;
    }

    public function quiz_attempts()
    {
        return $this->hasMany(QuizAttempt::class)->latest();
    }

    public function get_progress(Course $course)
    {
        $numberOfModules = $course->number_of_modules;

        $progress = ($this->progress / $numberOfModules) * 100;
        return $progress;
    }
}
