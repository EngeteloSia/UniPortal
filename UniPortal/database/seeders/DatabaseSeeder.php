<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    User::updateOrCreate(
        ['email' => 'test@example.com'],
        [
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
        ]
    );

    $this->call([
        UserSeeder::class,          // create lecturers and students first
        CourseSeeder::class,        // optional, if you want simple test courses
        CourseWithModulesSeeder::class,  // creates courses with modules assigned to first lecturer
        EnrollmentSeeder::class,    // enroll students after courses exist
    ]);
}
}
