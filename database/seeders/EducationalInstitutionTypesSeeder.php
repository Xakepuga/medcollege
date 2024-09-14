<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_institution_types')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'Общеобразовательное'
            ],
            [
                'name' => 'Начального профессионального образования'
            ],
            [
                'name' => 'Средне-профессионального образования'
            ],
            [
                'name' => 'Высшего профессионального образования'
            ],
        ];

        return $data;
    }
}
