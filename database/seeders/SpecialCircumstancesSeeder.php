<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialCircumstancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('special_circumstances')->insert($this->getData());
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Абитуриент нуждается в создании специальных условий при проведении вступительных испытаний',
                'permission_remove' => 0,
            ],
            [
                'name' => 'Наличие инвалидности',
                'permission_remove' => 0,
            ],
            [
                'name' => 'Потребность в общежитии',
                'permission_remove' => 0,
            ],
            [
                'name' => 'Ребёнок или участник СВО',
                'permission_remove' => 0,
            ],
            [
                'name' => 'Абитуриент является сиротой',
                'permission_remove' => 0,
            ],
            [
                'name' => 'Абитуриент является иностранцем',
                'permission_remove' => 1,
            ]
        ];
    }
}
