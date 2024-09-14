<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentsParentFather>
 */
class StudentsParentFatherFactory extends Factory
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
            'name' => fake()->firstName('male'),
            'surname' => fake()->lastName(),
            'patronymic' => fake()->firstNameMale(),
            'phone' => fake()->e164PhoneNumber(),
        ];
    }
}
