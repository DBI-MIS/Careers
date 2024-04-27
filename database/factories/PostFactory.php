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
        $title = fake()->jobTitle();

        return [
            'title' => $title,
            'date_posted' => now(),
            'user_id' => 1,
            'post_description' => fake()->paragraph(),
            'post_responsibility' => fake()->paragraph(),
            'post_qualification' => fake()->paragraph(),
            'job_level' => fake()->word(),
            'job_location' => fake()->word(),
            'job_type' => fake()->word(),
            // 'categories' => CategoryFactory::class,
            'slug' =>Str($title, '-'),
            'status' => 0,
            'featured' => 0,

        ];
    }
}
