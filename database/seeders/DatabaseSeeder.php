<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'marlonpadilla1593@gmail.com',
            'email_verified_at'=>Carbon::now()
        ]);
         \App\Models\User::factory(10)->create();
         \App\Models\Subject::factory(30)->create();
        // \App\Models\Course::factory(30)->create();
         \App\Models\Department::factory(3)->create();

         $courses = [

            [
                "name"=> "BSIT",
                "description"=>"Bachelor of Science in Information Technology"
            ],
            [
                "name"=> "BSBA",
                "description"=>"Bachelor of Science in Business Administration"
            ],
            [
                "name"=> "BSED",
                "description"=>"Bachelor of Sciend in Education"
            ]
            ];


            foreach ($courses as $course) {
                \App\Models\Course::create($course);
            }

    }
}
