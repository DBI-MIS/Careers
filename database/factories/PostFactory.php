<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word();

        return [
            'title' => $title,
            'date_posted' => now(),
            'user_id' => 1,
            'post_description' => fake()->paragraph(),
            'post_responsibility' => fake()->paragraph(),
            'post_qualification' => fake()->paragraph(),
            'job_level' => fake()->sentence('1'),
            'job_location' => fake()->sentence('1'),
            'job_type' => fake()->sentence('1'),
            'slug' =>Str($title, '-'),
            'status' => 0,
            'featured' => 0,

        ];
    }
}
