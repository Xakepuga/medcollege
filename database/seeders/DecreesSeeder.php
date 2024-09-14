<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DecreesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('decrees')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            [
                'name' => '311/У'
            ],
            [
                'name' => '312/У'
            ],
            [
                'name' => '321/У'
            ],
            [
                'name' => '322/У'
            ],
            [
                'name' => '374/У'
            ],
            [
                'name' => '377/У'
            ],
            [
                'name' => '445/У'
            ],
            [
                'name' => '447/У'
            ],
        ];

        return $data;
    }
}
