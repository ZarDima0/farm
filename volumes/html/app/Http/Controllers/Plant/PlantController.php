<?php
namespace App\Http\Controllers\Plant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\PlantGetRequest;
use App\Http\Resources\Plant\PlantResource;
use App\Http\Services\Plant\PlantServices;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\Responses\Plant\PlantResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;


#[OpenApi\PathItem]
class PlantController extends Controller
{

    #[OpenApi\Operation(tags: ['plant'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: PlantResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
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
