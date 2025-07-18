<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
        User::updateOrCreate(
            ['email' => 'alice@uni.test'],
            [
                'name' => 'Dr. Alice',
                'password' => Hash::make('password'),
                'role' => 'lecturer',
            ]
        );

        User::updateOrCreate(
            ['email' => 'bob@uni.test'],
            [
                'name' => 'Dr. Bob',
                'password' => Hash::make('password'),
                'role' => 'lecturer',
            ]
        );

        
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "student{$i}@uni.test"],
                [
                    'name' => "Student {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]
            );
        }
    }
}
