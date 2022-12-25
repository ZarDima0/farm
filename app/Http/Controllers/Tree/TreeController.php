<?php
namespace App\Http\Controllers\Tree;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tree\TreeGetRequest;
use App\Http\Resources\Tree\TreeResource;
use App\Http\Services\Tree\TreeServices;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\Responses\Tree\TreeResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;


#[OpenApi\PathItem]
class TreeController extends Controller
{

    #[OpenApi\Operation(tags: ['tree'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: TreeResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param TreeGetRequest $request
     * @param TreeServices $treeServices
     * @return AnonymousResourceCollection
     */
    public function getList(TreeGetRequest $request, TreeServices $treeServices): AnonymousResourceCollection
    {
        return TreeResource::collection($treeServices->getList());
    }
}
