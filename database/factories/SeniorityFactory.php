<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seniority>
 */
class SeniorityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $studentMax = config('factories.studentsCount');

        return [
            'student_id' => fake()->numberBetween(1, $studentMax),
            'place_work' => fake()->company(),
            'profession' => fake()->jobTitle(),
            'years' => fake()->randomNumber(2, false),
            'months' => fake()->randomNumber(2, false),
        ];
    }
}
