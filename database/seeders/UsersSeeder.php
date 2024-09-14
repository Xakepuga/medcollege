<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Николай',
                'surname' => 'Яргин',
                'email' => 'nickolas7159@gmail.com',
                'password' => '$2y$10$//PFEunZ6d4tU314kxEaD.nXbGfWbKSu2BNDwHGGJB1h1p0woTumq',
                'is_admin' => 1,
            ],
        ];
    }
}
