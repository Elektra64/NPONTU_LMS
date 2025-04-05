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
        return $this->hasMany(Module::class)->orderBy('module_number', 'asc');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category');
    }
    public function change_status()
    {
        $this->status =  $this->number_of_modules === $this->modules->count() ? 'published' : 'draft';
    }

    public function setColor($category, $type, $difficulty = false)
    {
        $color = null;
        switch ($type) {
            case 'bg':
                $color =  match ($category) {
                    'Web Development' => 'bg-green-50',
                    'Data Science' => 'bg-purple-50',
                    'Design' => 'bg-blue-50',
                    'Business' => 'bg-yellow-50',
                    default => 'bg-gray-50'
                };
                break;

            case 'text':
                $color =  match ($category) {
                    'Web Development' => 'text-green-600',
                    'Data Science' => 'text-purple-600',
                    'Design' => 'text-blue-600',
                    'Business' => 'text-yellow-600',
                    default => 'text-gray-600'
                };
                break;

            case 'badge':
                $difficulty ?
                    $color = match ($category) {
                        'Beginner' => "bg-green-100 text-green-800",
                        'Intermediate' => "bg-yellow-100 text-yellow-800",
                        'Advanced' => "bg-red-100 text-red-800",
                        default => 'bg-gray-100 text-gray-800',
                    }
                    :
                    $color = match ($category) {
                        'Web Development' => 'bg-green-100 text-green-800',
                        'Data Science' => 'bg-purple-100 text-purple-800',
                        'Design' => 'bg-blue-100 text-blue-800',
                        'Business' => 'bg-yellow-100 text-yellow-800',
                        default => 'bg-gray-100 text-gray-800'
                    };
        }

        return $color;
    }

    public function quiz_questions()
    {
        return $this->hasManyThrough(QuizQuestion::class, Module::class);
    }
}
