<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['first_name', 'last_name', 'username', 'password', 'email', 'role'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'created_by', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'enrolled_by')->latest();
    }

    public function quiz_attempts()
    {
        return $this->hasManyThrough(QuizAttempt::class, Enrollment::class, 'enrolled_by');
    }

    public function enrolled($course)
    {
        $user = $this->enrollments()->where('course_id', $course->id)->first();
        $value = $user ? True : False;
        return $value;
    }

    public function monthly_courses_published()
    {
        $today = Carbon::now();
        $coursesMonth = [];
        $months = $this->courses->map(fn($course) => $course->created_at->month);
        foreach ($months as $month) {
            $month === $today->month ? array_push($coursesMonth, $month) : '';
        }
        return count($coursesMonth);
    }

    public function course_enrollments()
    {
        return $this->hasManyThrough(Enrollment::class, Course::class, 'created_by');
    }

    // getting the quizzes this instructor has set
    // not ideal way of doing it so you can change later 
    // just wanted something done without altering the current database 
    public function quizzes_set()
    {
        $quizzes = [];
        $usersCourses = $this->courses;
        foreach ($usersCourses as $course) {
            array_push($quizzes, $course->quiz_questions->count());
        }
        $sum = 0;
        array_map(function ($count) use (&$sum) {
            $sum += $count;
        }, $quizzes);

        return $sum;
    }
}
