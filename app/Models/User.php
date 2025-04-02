<?php

namespace App\Models;

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
}
