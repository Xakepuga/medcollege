<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'Английский'
            ],
            [
                'name' => 'Немецкий'
            ],
            [
                'name' => 'Французский'
            ],
            [
                'name' => 'Другой'
            ],
            [
                'name' => 'Не изучал'
            ],
        ];

        return $data;
    }
}
