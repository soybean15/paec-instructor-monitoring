<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'marlonpadilla1593@gmail.com',
        // ]);
         \App\Models\User::factory(10)->create();
         \App\Models\Subject::factory(30)->create();
         \App\Models\Course::factory(30)->create();
         \App\Models\Department::factory(3)->create();


    }
}
