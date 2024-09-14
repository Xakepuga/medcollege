<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'birthday' => fake()->date(),
            'birthplace' => fake()->address(),
            'number' => fake()->randomNumber(9, true),
            'gender' => fake()->title(),
            'nationality_id' => fake()->numberBetween(1, 14),
            'issue_by' => fake()->address(),
            'issue_date' => fake()->date(),
            'address_registered' => fake()->address(),
            'address_residential' => fake()->address(),
        ];
    }
}
