<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create instructor
        User::create([
            'name' => 'John Instructor',
            'email' => 'instructor@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('instructor123'), // Custom password for instructor
            'role' => 'instructor',
        ]);

        // Create students
        User::create([
            'name' => 'Jane Student',
            'email' => 'student@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('student123'), // Custom password for Jane
            'role' => 'student',
        ]);

        User::create([
            'name' => 'kent',
            'email' => 'krmadera01@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('kent123'), // Custom password for kent
            'role' => 'student',
        ]);
    }
}