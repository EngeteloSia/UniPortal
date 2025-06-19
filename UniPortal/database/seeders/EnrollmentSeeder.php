<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        foreach ($students as $student) {
            // Enroll each student in 1 to 2 random courses
            $student->enrolledCourses()->attach(
                $courses->random(rand(1, min(2, $courses->count())))->pluck('id')
            );
        }
    }
}
