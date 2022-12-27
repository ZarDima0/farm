<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlantsSeeder::class);
        $this->call(Building::class);
        $this->call(TreesSeeder::class);
//        $this->call(CropSeeder::class);
    }
}
