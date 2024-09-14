<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationForAdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information_for_admission')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        $studentMax = config('factories.studentsCount');
        $count = 200;

        for ($i = 1; $i <= $count; $i++) {
            $data[] = [
                'student_id' => fake()->numberBetween(1, $studentMax),
                'faculty_id' => fake()->numberBetween(1, 10),
                'financing_type_id' => fake()->numberBetween(1, 3),
                'is_original_docs' => fake()->numberBetween(0, 1),
                'testing' => fake()->randomFloat(2, 0, 9.99),
            ];
        }

        return $data;
    }
}
