<?php

namespace App\Http\Controllers\BuildingFarm;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\CreateBuildingFarmLandRequest;
use App\Http\Resources\FarmLand\CreateFarmLandBuildingsResource;
use App\Http\Resources\FarmLand\GetFarmLandBuildingResource;
use App\Http\Services\FarmLand\FarmLandServices;
use App\OpenApi\RequestBodies\BuildingFarm\CreateBuidingsFamLandRequestBody;
use App\OpenApi\Responses\BuildingFarm\BuildingFarmResponse;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class BuildingFarmController extends Controller
{

    #[OpenApi\Operation(tags: ['BuildingFarm'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: BuildingFarmResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param $id
     * @param FarmLandServices $farmLandServices
     * @return AnonymousResourceCollection
     */
    public function getBuildings($id, FarmLandServices $farmLandServices): AnonymousResourceCollection
    {
        return GetFarmLandBuildingResource::collection($farmLandServices->getBuildings($id));
    }

    #[OpenApi\Operation(tags: ['BuildingFarm'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: CreateBuidingsFamLandRequestBody::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
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
    ): CreateFarmLandBuildingsResource
    {
        return new CreateFarmLandBuildingsResource($farmLandServices->createBuildings($CreateBuildingFarmLandRequest->getCreateBuilderDTO(), $id));
    }
}
