<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Building extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Building::create([
             'name' => 'Дом',
             'tiles' => '80',
         ]);
        \App\Models\Building::create([
            'name' => 'Амбар',
            'tiles' => '100',
        ]);
    }
}
