<?php

namespace App\Http\Controllers\BuildingFarm;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\CreateBuildingFarmLandRequest;
use App\Http\Resources\FarmLand\CreateFarmLandBuildingsResource;
use App\Http\Resources\FarmLand\GetFarmLandBuildingResource;
use App\Http\Services\FarmLand\FarmLandServices;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BuildingFarmController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function getBuildings($id, FarmLandServices $farmLandServices): AnonymousResourceCollection
    {
        return GetFarmLandBuildingResource::collection($farmLandServices->getBuildings($id));
    }

    /**
     * @param CreateBuildingFarmLandRequest $CreateBuildingFarmLandRequest
     * @param $id
     * @param FarmLandServices $farmLandServices
     * @return null
     * @throws Exception
     */
    public function createBuildings(
        CreateBuildingFarmLandRequest $CreateBuildingFarmLandRequest,
        $id,
        FarmLandServices $farmLandServices
    ): CreateFarmLandBuildingsResource
    {
        return new CreateFarmLandBuildingsResource($farmLandServices->createBuildings($CreateBuildingFarmLandRequest->getCreateBuilderDTO(), $id));
    }
}
