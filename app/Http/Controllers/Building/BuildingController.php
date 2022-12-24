<?php
namespace App\Http\Controllers\Building;

use App\Http\Controllers\Controller;
use App\Http\Requests\Building\BuildingGetRequest;
use App\Http\Resources\Building\BuildingResource;
use App\Http\Services\Building\BuildingServices;
use App\OpenApi\Responses\Building\BuildingResponse;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class BuildingController extends Controller
{
    #[OpenApi\Operation(tags: ['building'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: BuildingResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param BuildingGetRequest $request
     * @param BuildingServices $buildingServices
     * @return AnonymousResourceCollection
     */
    public function getList(BuildingGetRequest $request, BuildingServices $buildingServices): AnonymousResourceCollection
    {
        return BuildingResource::collection($buildingServices->getList());
    }
}
