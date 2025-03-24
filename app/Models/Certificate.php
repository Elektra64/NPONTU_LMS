<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'issued_date', 'certificate_url'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}

