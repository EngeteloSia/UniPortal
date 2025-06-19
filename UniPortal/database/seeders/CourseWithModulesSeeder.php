<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Module;
use App\Models\User;

class CourseWithModulesSeeder extends Seeder
{
    public function run()
    {
        // Find a lecturer user to assign courses to
        $lecturer = User::where('role', 'lecturer')->first();

        if (!$lecturer) {
            $this->command->error('No lecturer user found. Please create one first.');
            return;
        }

        // Example courses with modules
        $coursesData = [
            [
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of HTML, CSS, and JavaScript.',
                'modules' => [
                    ['title' => 'HTML Basics', 'description' => 'Structure web pages with HTML.'],
                    ['title' => 'CSS Fundamentals', 'description' => 'Style web pages using CSS.'],
                    ['title' => 'JavaScript Introduction', 'description' => 'Make web pages interactive with JS.'],
                ],
            ],
            [
                'title' => 'Database Systems',
                'description' => 'Understand database concepts and SQL.',
                'modules' => [
                    ['title' => 'Relational Databases', 'description' => 'Basics of relational database systems.'],
                    ['title' => 'SQL Queries', 'description' => 'Learn to write SQL queries.'],
                    ['title' => 'Normalization', 'description' => 'Organize database structure efficiently.'],
                ],
            ],
            [
                'title' => 'Object-Oriented Programming',
                'description' => 'Learn OOP concepts using PHP.',
                'modules' => [
                    ['title' => 'Classes and Objects', 'description' => 'Understand the basics of classes and objects.'],
                    ['title' => 'Inheritance', 'description' => 'Reusing code with inheritance.'],
                    ['title' => 'Polymorphism', 'description' => 'Understanding polymorphism in OOP.'],
                ],
            ],
        ];

        foreach ($coursesData as $courseData) {
            $course = Course::create([
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'lecturer_id' => $lecturer->id,
            ]);

            foreach ($courseData['modules'] as $moduleData) {
                $course->modules()->create($moduleData);
            }
        }

        $this->command->info('Courses and modules seeded successfully.');
    }
}
