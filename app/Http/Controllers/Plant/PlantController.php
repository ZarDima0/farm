<?php
namespace App\Http\Controllers\Plant;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Requests\Plant\PlantGetRequest;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Services\FarmLand\FarmLandServices;
use App\Http\Services\Plant\PlantServices;
use Illuminate\Support\Facades\Auth;

class PlantController extends Controller
{
    /**
     * @param PlantGetRequest $request
     * @param PlantServices $plantServices
     * @return PlantServices
     */
    public function getList(PlantGetRequest $request, PlantServices $plantServices): PlantServices
    {
        return new PlantServices($plantServices->getList());
    }
}
