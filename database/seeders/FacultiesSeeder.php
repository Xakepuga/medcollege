<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => '31.02.01 Лечебное дело'
            ],
            [
                'name' => '31.02.02 Акушерское дело'
            ],
            [
                'name' => '31.02.03 Лабораторная диагностика'
            ],
            [
                'name' => '31.02.04 Медицинская оптика'
            ],
            [
                'name' => '31.02.05 Стоматология ортопедическая'
            ],
            [
                'name' => '31.02.06 Стоматология профилактическая'
            ],
            [
                'name' => '32.02.01 Медико-профилактическое дело'
            ],
            [
                'name' => '33.02.01 Фармация'
            ],
            [
                'name' => '34.01.01 Младшая медицинская сестра по уходу за больными'
            ],
            [
                'name' => '34.02.01 Сестринское дело (очная форма)'
            ],
            [
                'name' => '34.02.01 Сестринское дело (очно-заочная форма)'
            ],
            [
                'name' => '34.02.01 Сестринское дело (очная форма) 9 класс'
            ],
        ];

        return $data;
    }
}
