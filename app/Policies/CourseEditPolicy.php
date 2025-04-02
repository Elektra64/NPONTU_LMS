<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CourseEditPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit_course(User $user, Course $course)
    {
        return $course->number_of_modules > $course->modules->count();
    }
}
