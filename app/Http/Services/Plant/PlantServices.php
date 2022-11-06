<?php
namespace App\Http\Services\Plant;

use App\Models\Plant;
use App\Models\User;

class PlantServices
{

    public function getList()
    {
        return Plant::all();
    }
}
