<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationality')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'РФ'
            ],
            [
                'name' => 'Азербайджан'
            ],
            [
                'name' => 'Казахстан'
            ],
            [
                'name' => 'Кыргыстан'
            ],
            [
                'name' => 'Украина'
            ],
            [
                'name' => 'Армения'
            ],
            [
                'name' => 'Белоруссия'
            ],
            [
                'name' => 'Грузия'
            ],
            [
                'name' => 'Молдова'
            ],
            [
                'name' => 'Таджикистан'
            ],
            [
                'name' => 'Туркменистан'
            ],
            [
                'name' => 'Узбекистан'
            ],
            [
                'name' => 'Эстония'
            ],
            [
                'name' => 'Республика Гана'
            ],
        ];

        return $data;
    }
}
