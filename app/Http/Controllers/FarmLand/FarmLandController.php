<?php
namespace App\Http\Controllers\FarmLand;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\CreateBuildingFarmLandRequest;
use App\Http\Requests\FarmLand\CreatePlantablesFarmLandRequest;
use App\Http\Requests\FarmLand\EditBuildingFarmLandRequest;
use App\Http\Requests\FarmLand\EditPlantablesFarmLandRequest;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Resources\FarmLand\CreateFarmLandBuildingsResource;
use App\Http\Resources\FarmLand\CreateFarmLandPlanResource;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Resources\FarmLand\GetFarmLandBuildingResource;
use App\Http\Resources\Farmland\GetFarmLandPlantResource;
use App\Http\Services\FarmLand\FarmLandServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class FarmLandController extends Controller
{
    /**
     * Создание фермы
     *
     * @param FarmLandCreateRequest $request
     * @param FarmLandServices $FarmLandServices
     * @return FarmLandResource
     */
    public function create(FarmLandCreateRequest $request, FarmLandServices $FarmLandServices): FarmLandResource
    {
        return new FarmLandResource($FarmLandServices->create($request->getName(), Auth::id()));
    }

    /**
     * Получение ферм пользователя
     *
     * @param FarmLandServices $FarmLandServices
     * @return AnonymousResourceCollection
     */
    public function getList(FarmLandServices $FarmLandServices): AnonymousResourceCollection
    {
        return FarmLandResource::collection($FarmLandServices->getList(Auth::id()));
    }

    /**
     * @param $id
     * @param $paginate
     * @param FarmLandServices $farmLandServices
     * @return AnonymousResourceCollection
     */
    public function getBuildings($id,$paginate,FarmLandServices $farmLandServices): AnonymousResourceCollection
    {
        return GetFarmLandBuildingResource::collection($farmLandServices->getBuildings($id, $paginate));
    }

    /**
     * Создание постройки на ферме
     *
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

    /**
     * Получение посадок на ферме
     *
     * @param $id
     * @param FarmLandServices $farmLandServices
     * @return AnonymousResourceCollection
     */
    public function getPlantables(
        $id,
        $paginate,
        FarmLandServices $farmLandServices
    ): AnonymousResourceCollection {
        return GetFarmLandPlantResource::collection($farmLandServices->getPlantables($id,$paginate));
    }

    /**
     * Создание посадок на ферме
     *
     * @param CreatePlantablesFarmLandRequest $createPlanFarmLandRequest
     * @param FarmLandServices $farmLandServices
     * @return CreateFarmLandPlanResource
     */
    public function createPlantables(
        CreatePlantablesFarmLandRequest $createPlanFarmLandRequest,
        FarmLandServices $farmLandServices
    ): CreateFarmLandPlanResource {
        return new CreateFarmLandPlanResource($farmLandServices->createPlantables($createPlanFarmLandRequest->getPlantFarmLandDTO()));
    }

    /**
     * Одна постройка
     *
     * @param $id
     * @param $idBuilding
     * @param FarmLandServices $farmLandServices
     * @return CreateFarmLandBuildingsResource
     */
    public function showBuilding($id,$idBuilding,FarmLandServices $farmLandServices)
    {
        return new CreateFarmLandBuildingsResource($farmLandServices->showBuilding($id, $idBuilding));
    }

    /**
     * Одна посадка
     *
     * @param $id
     * @param $idPlantable
     * @param FarmLandServices $farmLandServices
     * @return CreateFarmLandPlanResource
     */
    public function showPlantable($id,$idPlantable, FarmLandServices $farmLandServices)
    {
        return new CreateFarmLandPlanResource($farmLandServices->showPlantable($id, $idPlantable));
    }

    /**
     *
     * Метод удаления посадки
     *
     * @param $id
     * @param $idBuilding
     * @param FarmLandServices $farmLandServices
     * @return void
     */
    public function deletePlantable($id,$idPlantable,FarmLandServices $farmLandServices)
    {
        return $farmLandServices->deletePlantable($id,$idPlantable);
    }

    /**
     *
     * Метод удаления постройки с фермы
     *
     * @param $id
     * @param $idPlantable
     * @param FarmLandServices $farmLandServices
     * @return void
     */
    public function deleteBuilding($id,$idBuilding,FarmLandServices $farmLandServices)
    {
        return $farmLandServices->deleteBuilding($id,$idBuilding);
    }
}
