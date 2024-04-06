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

        // Post::factory()
        //     ->count(50)
        //     ->hasUser(1)
        //     ->hasCategory(1)
        //     ->create();
        

    }
}
