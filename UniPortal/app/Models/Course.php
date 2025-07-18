<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'lecturer_id'];

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
    }
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
    public function marks()
{
    return $this->hasMany(Mark::class);
}
public function enrollmentRequests()
{
    return $this->hasMany(CourseEnrollment::class, 'course_id');
}

}
