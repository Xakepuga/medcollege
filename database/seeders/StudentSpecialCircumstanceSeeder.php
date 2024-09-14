<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSpecialCircumstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_special_circumstance')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        $studentMax = config('factories.studentsCount');
        $count = 500;

        for ($i = 1; $i <= $count; $i++) {
            $data[] = [
                'student_id' => fake()->numberBetween(1, $studentMax),
                'special_circumstance_id' => fake()->numberBetween(1, 6),
                'status' => fake()->numberBetween(0, 1),
            ];
        }

        return $data;
    }
}
