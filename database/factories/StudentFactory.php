<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $studentMax = config('factories.studentsCount');
        $languageMax = 5;

        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'patronymic' => fake()->firstNameMale(),
            'passport_id' => fake()->numberBetween(1, $studentMax),
            'phone' => fake()->e164PhoneNumber(),
            'email' => fake()->email(),
            'language_id' => fake()->numberBetween(1, $languageMax),
            'about_me' => fake()->text(100),
        ];
    }
}
