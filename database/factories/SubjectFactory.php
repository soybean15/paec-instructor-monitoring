<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition(): array
    {
        return [
            'name'=>fake()->jobTitle(),
            'description'=>fake()->sentence(10),
            'year_level'=>rand(1,4),
            'semester'=>rand(1,2),
            'number_of_units'=>rand(1,5),
            'user_id'=>1,
            'course_id'=>null
    
        ];
    }
}
