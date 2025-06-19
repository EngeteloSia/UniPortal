<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturers = User::where('role', 'lecturer')->get();

        foreach ($lecturers as $index => $lecturer) {
            Course::create([
                'title' => 'Course ' . ($index + 1),
                'description' => 'This is a test course created for ' . $lecturer->name,
                'lecturer_id' => $lecturer->id,
            ]);
        }
    }
}
