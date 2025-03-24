<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'quiz_id', 'score', 'time_taken'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}

