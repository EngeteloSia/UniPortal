<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 lecturers
        User::create([
            'name' => 'Dr. Alice',
            'email' => 'alice@uni.test',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
        ]);

        User::create([
            'name' => 'Dr. Bob',
            'email' => 'bob@uni.test',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
        ]);

        // Create 5 students
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Student ' . $i,
                'email' => 'student' . $i . '@uni.test',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);
        }
    }
}
