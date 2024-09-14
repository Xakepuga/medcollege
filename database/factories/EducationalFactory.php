<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Educational>
 */
class EducationalFactory extends Factory
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
            'ed_institution_type_id' => fake()->numberBetween(1, 4),
            'ed_doc_type_id' => fake()->numberBetween(1, 5),
            'ed_doc_number' => fake()->randomNumber(7, true),
            'ed_institution_name' => fake()->catchPhrase(),
            'is_first_spo' => fake()->boolean(),
            'is_excellent_student' => fake()->boolean(),
            'avg_rating' => fake()->randomFloat(2, 1, 5),
            'issue_date' => fake()->date(),
        ];
    }
}
