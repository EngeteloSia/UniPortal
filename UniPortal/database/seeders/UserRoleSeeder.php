<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Example: create a lecturer user (or update existing)
        $lecturer = User::firstOrCreate(
            ['email' => 'lecturer@example.com'],
            [
                'name' => 'Lecturer One',
                'password' => bcrypt('password123'),
                'role' => 'lecturer',
            ]
        );

        // Example: create a student user (or update existing)
        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student One',
                'password' => bcrypt('password123'),
                'role' => 'student',
            ]
        );
    }
}
