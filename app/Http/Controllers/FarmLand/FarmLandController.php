<?php
namespace App\Http\Controllers\FarmLand;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\CreateBuildingFarmLandRequest;
use App\Http\Requests\FarmLand\CreatePlantablesFarmLandRequest;
use App\Http\Requests\FarmLand\EditBuildingFarmLandRequest;
use App\Http\Requests\FarmLand\EditPlantablesFarmLandRequest;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Requests\Paginate\FarmLandRequest;
use App\Http\Resources\FarmLand\CreateFarmLandBuildingsResource;
use App\Http\Resources\FarmLand\CreateFarmLandPlanResource;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Resources\FarmLand\GetFarmLandBuildingResource;
use App\Http\Resources\Farmland\GetFarmLandPlantResource;
use App\Http\Services\FarmLand\FarmLandServices;
use App\OpenApi\RequestBodies\FarmLand\CreateBuidingsFamLandRequestBody;
use App\OpenApi\RequestBodies\FarmLand\CreateFarmLandRequestBody;
use App\OpenApi\RequestBodies\FarmLand\CreatePlantablesFamLandRequestBody;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ForbiddenErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\Responses\FarmLand\BuildingFarmLandResponse;
use App\OpenApi\Responses\FarmLand\DestroyBuildingFarmLandResponse;
use App\OpenApi\Responses\FarmLand\DestroyPlantableFarmLandResponse;
use App\OpenApi\Responses\FarmLand\FarmLandResponse;
use App\OpenApi\Responses\FarmLand\PlantableFarmLandResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class FarmLandController extends Controller
{

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateFarmLandRequestBody::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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

    #[OpenApi\Operation(tags: ['farmLand'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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

    #[OpenApi\Operation(tags: ['farmLand'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param $id
     * @param FarmLandRequest $request
     * @param FarmLandServices $farmLandServices
     * @return AnonymousResourceCollection
     */
    public function getBuildings($id,FarmLandRequest $request,FarmLandServices $farmLandServices): AnonymousResourceCollection
    {
        return GetFarmLandBuildingResource::collection($farmLandServices->getBuildings($id, $request->getPage()));
    }

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateBuidingsFamLandRequestBody::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * Создание постройки на ферме
     *
     * @param CreateBuildingFarmLandRequest $CreateBuildingFarmLandRequest
     * @param $id
     * @param FarmLandServices $farmLandServices
     * @return CreateFarmLandBuildingsResource
     * @throws Exception
     */
    public function createBuildings(
        CreateBuildingFarmLandRequest $CreateBuildingFarmLandRequest,
        $id,
        FarmLandServices $farmLandServices
    ): CreateFarmLandBuildingsResource {
        return new CreateFarmLandBuildingsResource($farmLandServices->createBuildings($CreateBuildingFarmLandRequest->getCreateBuilderDTO(), $id));
    }

    #[OpenApi\Operation(tags: ['farmLand'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * Получение посадок на ферме
     *
     * @param $id
     * @param FarmLandRequest $request
     * @param FarmLandServices $farmLandServices
     * @return AnonymousResourceCollection
     */
    public function getPlantables(
        $id,
        FarmLandRequest $request,
        FarmLandServices $farmLandServices
    ): AnonymousResourceCollection {
        return GetFarmLandPlantResource::collection($farmLandServices->getPlantables($id,$request->getPage()));
    }

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreatePlantablesFamLandRequestBody::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: BuildingFarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ForbiddenErrorResponse::class, statusCode: 403)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: PlantableFarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ForbiddenErrorResponse::class, statusCode: 403)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: DestroyPlantableFarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ForbiddenErrorResponse::class, statusCode: 403)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     *
     * Метод удаления посадки
     *
     * @param $id
     * @param $idPlantable
     * @param FarmLandServices $farmLandServices
     * @return void
     */
    public function deletePlantable($id,$idPlantable,FarmLandServices $farmLandServices)
    {
        return $farmLandServices->deletePlantable($id,$idPlantable);
    }

    #[OpenApi\Operation(tags: ['farmLand'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: DestroyBuildingFarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ForbiddenErrorResponse::class, statusCode: 403)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     *
     * Метод удаления постройки с фермы
     *
     * @param $id
     * @param $idBuilding
     * @param FarmLandServices $farmLandServices
     * @return void
     */
    public function deleteBuilding($id,$idBuilding,FarmLandServices $farmLandServices)
    {
        return $farmLandServices->deleteBuilding($id,$idBuilding);
    }
}
