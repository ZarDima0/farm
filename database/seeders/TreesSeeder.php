<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tree::create([
            'name' => 'Кедр',
            'tiles' => 200,
            'height' => 35,
        ]);
        \App\Models\Tree::create([
            'name' => 'Береза',
            'tiles' => 80,
            'height' => 20,
        ]);
    }
}
