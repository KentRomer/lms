<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(5),
            'content' => fake()->paragraphs(5, true),
            'order' => 1,
        ];
    }
}