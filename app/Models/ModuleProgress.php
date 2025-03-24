<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleProgress extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'module_id', 'completed', 'completion_date'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

