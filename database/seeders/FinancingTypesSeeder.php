<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('financing_types')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'Бюджет'
            ],
            [
                'name' => 'Договор'
            ],
            [
                'name' => 'Возможен договор'
            ],
            [
                'name' => 'Целевое обучение'
            ],
        ];

        return $data;
    }
}
