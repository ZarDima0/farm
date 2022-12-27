<?php
namespace App\Http\Services\Building;

use App\Models\Building;
use App\Models\Plant;

class BuildingServices
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(): \Illuminate\Database\Eloquent\Collection
    {
        return Building::all();
    }
}
