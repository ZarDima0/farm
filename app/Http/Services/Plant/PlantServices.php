<?php
namespace App\Http\Services\Plant;

use App\Models\Plant;

class PlantServices
{

    public function getList()
    {
        return Plant::All();
    }
}
