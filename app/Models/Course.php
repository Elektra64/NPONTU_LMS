<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'difficulty_level',
        'duration',
        'credit_hours',
        'number_of_modules',
        'status',
        'created_by',
        'final_exam_weight'
    ];




    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category');
    }
    public function change_status()
    {
        $this->status =  $this->number_of_modules === $this->modules->count() ? 'published' : 'draft';
    }
}
