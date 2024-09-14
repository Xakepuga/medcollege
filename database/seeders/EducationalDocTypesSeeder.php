<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalDocTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_doc_types')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => 'Аттестат'
            ],
            [
                'name' => 'Аттестат основного общего'
            ],
            [
                'name' => 'Аттестат среднего общего'
            ],
            [
                'name' => 'Диплом'
            ],
            [
                'name' => 'Диплом НПО'
            ],
            [
                'name' => 'Диплом СПО'
            ],
            [
                'name' => 'Диплом ВПО'
            ],
        ];

        return $data;
    }
}
