<?php
namespace App\Http\Controllers\FarmLand;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\CreateBuildingFarmLandRequest;
use App\Http\Requests\FarmLand\CreatePlantablesFarmLandRequest;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Resources\FarmLand\CreateFarmLandBuildingsResource;
use App\Http\Resources\FarmLand\CreateFarmLandPlanResource;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Resources\FarmLand\GetFarmLandBuildingResource;
use App\Http\Resources\Farmland\GetFarmLandPlantResource;
use App\Http\Services\FarmLand\FarmLandServices;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class FarmLandController extends Controller
{
    /**
     * @param FarmLandCreateRequest $request
     * @param FarmLandServices $FarmLandServices
     * @return FarmLandResource
     */
    public function create(FarmLandCreateRequest $request, FarmLandServices $FarmLandServices): FarmLandResource
    {
        return new FarmLandResource($FarmLandServices->create($request->getName(), Auth::id()));
    }

    /**
     * @param FarmLandServices $FarmLandServices
     * @return FarmLandResource
     */
    public function getList(FarmLandServices $FarmLandServices): AnonymousResourceCollection
    {
        return FarmLandResource::collection($FarmLandServices->getList(Auth::id()));
    }

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
    ): CreateFarmLandBuildingsResource {
        return new CreateFarmLandBuildingsResource($farmLandServices->createBuildings($CreateBuildingFarmLandRequest->getCreateBuilderDTO(), $id));
    }

    public function getPlantables(
        $id,
        FarmLandServices $farmLandServices
    ): AnonymousResourceCollection {
        return GetFarmLandPlantResource::collection($farmLandServices->getPlantables($id));
    }

    public function createPlantables(
        CreatePlantablesFarmLandRequest $createPlanFarmLandRequest,
        FarmLandServices $farmLandServices
    ): CreateFarmLandPlanResource {
        return new CreateFarmLandPlanResource($farmLandServices->createPlantables($createPlanFarmLandRequest->getPlantFarmLandDTO()));
    }
}
