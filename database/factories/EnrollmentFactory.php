<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
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
            'faculty_id' => fake()->numberBetween(1, 10),
            'decree_id' => fake()->numberBetween(1, 6),
            'is_budget' => fake()->boolean(),
            'is_pickup_docs' => fake()->boolean(),
        ];
    }
}
