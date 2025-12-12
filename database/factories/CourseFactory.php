<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory()->instructor(),
            'title' => fake()->sentence(4),
            'short_description' => fake()->sentence(10),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}