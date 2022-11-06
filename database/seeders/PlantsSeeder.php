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
        $plant = [
            [   'name' => 'Пшеница',
                'fruit' => 'Зерно пшеницы',
                'is_harvestable' => 1,
                'is_perennial' => 0,
            ],
            [
                'name' => 'Клубника',
                'is_harvestable' => 1,
                'is_perennial' => 0,
            ],
            [
                'name' => 'Розовый куст',
                'is_harvestable' => 0,
                'is_perennial' => 1,
            ]
        ];

        foreach ($plant as $item) {
            Plant::create([
                'name' => $item['name'],
                'is_harvestable' =>$item['is_harvestable'],
                'is_perennial' => $item['is_perennial'],
            ]);
        }
    }

}
