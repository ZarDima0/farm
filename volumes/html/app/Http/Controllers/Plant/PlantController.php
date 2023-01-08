<?php
namespace App\Http\Controllers\Plant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plant\PlantGetRequest;
use App\Http\Resources\Plant\PlantResource;
use App\Http\Services\Plant\PlantServices;
use App\Models\Plant;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\Responses\Plant\PlantResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use GuzzleHttp\Client;
use http\Client\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;
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

    /**
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws AuthenticationException
     */
    public function search(\Illuminate\Http\Request $request)
    {
        $client = ClientBuilder::create()
            ->setHosts(['localhost:9300'])
            ->setSSLVerification(false)
            ->build();
        dd($client->info());
        $q = $request->get('q');
        if ($q) {
            $response = $client->search([
                'index' => 'plants',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => [
                                'name',
                                'history'
                            ]
                        ]
                    ]
                ]
            ]);
            dd($response);
            $PlantsIds = array_column($response['hits']['hits'], '_id');
            dd($PlantsIds);
        }
    }
}
