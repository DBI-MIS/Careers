<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => fake()->title(),
            'date_post' => now(),
            'user_id' => User::factory(),
            'post_description' => fake()->paragraph(),
            'post_responsibility' => fake()->paragraph(),
            'post_qualification' => fake()->paragraph(),

        ];
    }
}
