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
//        foreach ($plants as $item) {
//            $plant = Plant::query()->create([
//                'name' => $item['name'],
//                'is_harvestable' =>$item['is_harvestable'],
//                'is_perennial' => $item['is_perennial'],
//            ]);
//            /**
//             * @var Plant $plant
//             */
//            if ($item['crop']) {
//                $plant->crop()->create($item['crop']);
//            }
//        }
//
//
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
