<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'Гражданство',
                'table' => 'nationality',
                'slug' => 'nationality',
            ],
            [
                'name' => 'Документ об образовании',
                'table' => 'educational_doc_types',
                'slug' => 'educational-doc',
            ],
            [
                'name' => 'Дополнительная информация (особые обстоятельства)',
                'table' => 'special_circumstances',
                'slug' => 'special-circumstances',
            ],
            [
                'name' => 'Иностранный язык',
                'table' => 'languages',
                'slug' => 'language',
            ],
            [
                'name' => 'Номер приказа',
                'table' => 'decrees',
                'slug' => 'decree-number',
            ],
            [
                'name' => 'Специальность',
                'table' => 'faculties',
                'slug' => 'faculty',
            ],
            [
                'name' => 'Учебное заведение',
                'table' => 'educational_institution_types',
                'slug' => 'educational-institution',
            ],
            [
                'name' => 'Финансирование',
                'table' => 'financing_types',
                'slug' => 'financing',
            ],
        ];

        return $data;
    }
}
