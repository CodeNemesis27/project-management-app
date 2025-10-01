<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Richard Sombrio',
            'email' => 'richard.sombrio27@gmail.com',
            'password' => Hash::make('password')
        ]);

        // Category::factory(10)->create();
        // Client::factory(10)->create();
        // Project::factory(10)->create();
        // Task::factory(10)->create();
    }
}
