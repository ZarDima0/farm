<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plants = [
            [   'name' => 'Пшеница',
                'is_harvestable' => 1,
                'is_perennial' => 0,
                'crop' => [
                    'name'=> 'Зерно пшеницы',
                    'yield_per_tile'=> 30,
                ],
            ],
            [
                'name' => 'Клубника',
                'is_harvestable' => 1,
                'is_perennial' => 0,
                'crop' => [
                    'name'=> 'Ягода клубники',
                    'yield_per_tile'=> 200,
                ],
            ],
            [
                'name' => 'Розовый куст',
                'is_harvestable' => 0,
                'is_perennial' => 1,
                'crop' => null
            ],
        ];

        foreach ($plants as $item) {
            $plant = Plant::query()->create([
                'name' => $item['name'],
                'is_harvestable' =>$item['is_harvestable'],
                'is_perennial' => $item['is_perennial'],
            ]);
            /**
             * @var Plant $plant
             */
            if ($item['crop']) {
                $plant->crop()->create($item['crop']);
            }
        }
    }

}
