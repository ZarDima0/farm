<?php

namespace Database\Seeders;

use App\Models\Crop;
use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plant = [
            [
                'plantable_type'=> 'App\Models\Tree',
                'plantable_id'=> 1,
                'name'=> 'ядро кедра',
                'yield_per_tile'=> 30,
            ],
            [
                'plantable_type'=> 'App\Models\Plant',
                'plantable_id'=> 1,
                'name'=> 'Зерно пшеницы',
                'yield_per_tile'=> 30,
            ],
            [
                'plantable_type'=> 'App\Models\Plant',
                'plantable_id'=> 1,
                'name'=> 'Ягода клубники',
                'yield_per_tile'=> 200,
            ]
        ];

        foreach ($plant as $item) {
            Crop::create([
                'name' => $item['name'],
                'plantable_type' =>$item['plantable_type'],
                'plantable_id' => $item['plantable_id'],
                'yield_per_tile' => $item['yield_per_tile']
            ]);
        }
    }

}
