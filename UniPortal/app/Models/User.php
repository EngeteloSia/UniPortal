<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CourseEnrollment;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


   public function courses()
    {
        return $this->hasMany(Course::class, 'lecturer_id');
    }


    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

  public function marks()
{
    return $this->hasMany(\App\Models\Mark::class, 'student_id');
}

public function enrollmentRequests()
{
    return $this->hasMany(CourseEnrollment::class, 'student_id');
}





}
