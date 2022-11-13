<?php
namespace App\Http\Controllers\Plant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\PlantGetRequest;
use App\Http\Resources\Plant\PlantResource;
use App\Http\Services\Plant\PlantServices;

class PlantController extends Controller
{
    /**
     * @param PlantGetRequest $request
     * @param PlantServices $plantServices
     * @return PlantResource
     */
    public function getList(PlantGetRequest $request, PlantServices $plantServices):PlantResource
    {
        return new PlantResource($plantServices->getList());
    }
}
