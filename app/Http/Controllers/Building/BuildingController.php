<?php
namespace App\Http\Controllers\Building;

use App\Http\Controllers\Controller;
use App\Http\Requests\Building\BuildingGetRequest;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Resources\Building\BuildingResource;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Services\Building\BuildingServices;
use App\Http\Services\FarmLand\FarmLandServices;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    /**
     * @param BuildingGetRequest $request
     * @param BuildingServices $buildingServices
     * @return BuildingResource
     */
    public function getList(BuildingGetRequest $request, BuildingServices $buildingServices): BuildingResource
    {
        return new BuildingResource($buildingServices->getList());
    }
}
