<?php

namespace Database\Seeders;

use App\Models\Tree;
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
        $trees = [
            [
                'name' => 'Кедр',
                'tiles' => 200,
                'height' => 35,
                'is_harvestable' => 1,
                'crop' => [
                    'name'=> 'Ядро кедра',
                    'yield_per_tile'=> 30,
                ],
            ],
            [
                'name' => 'Береза',
                'tiles' => 80,
                'height' => 20,
                'is_harvestable' => 0,
                'crop' => null
            ],
        ];



        foreach ($trees as $item) {
            $tree = Tree::query()->create([
                'name' => $item['name'],
                'tiles' => $item['tiles'],
                'height' => $item['height'],
                'is_harvestable' =>$item['is_harvestable'],
            ]);
            /**
             * @var Tree $tree
             */
            if ($item['crop']) {
                $tree->crop()->create($item['crop']);
            }
        }
    }
}
