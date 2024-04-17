<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->create([
            'name' => 'Admin',
            'email' => 'admin@dbiphils.com',
            'password' => Hash::make('password'),
        ]);

        Post::factory()
    
        ->create([

            'title' => 'Administrative Staff',
            'date_posted' => now(),
            'user_id' => 1,
            'post_description' => fake()->paragraph(),
            'post_responsibility' => fake()->paragraph(),
            'post_qualification' => fake()->paragraph(),
            'job_level' => fake()->sentence('1'),
            'job_location' => fake()->sentence('1'),
            'job_type' => fake()->sentence('1'),
            'slug' => 'adminstrative-staff',
            'status' => 1,
            'featured' => 1,

        ]);

        Category::factory()
        ->create(
            [
                'title' => 'Admin',
                'slug' => 'admin',
                'text_color' => 'white',
                'bg_color' => 'blue',
            ]
        );
        

    }
}
