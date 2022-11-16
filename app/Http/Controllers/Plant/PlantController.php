<?php
namespace App\Http\Controllers\Plant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\PlantGetRequest;
use App\Http\Resources\Plant\PlantResource;
use App\Http\Services\Plant\PlantServices;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlantController extends Controller
{
    /**
     * @param PlantGetRequest $request
     * @param PlantServices $plantServices
     * @return AnonymousResourceCollection
     */
    public function getList(PlantGetRequest $request, PlantServices $plantServices): AnonymousResourceCollection
    {
        return PlantResource::collection($plantServices->getList());
    }
}
