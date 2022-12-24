<?php
namespace App\Http\Controllers\User;

use App\Http\Resources\User\UserShowResource;
use App\Models\User;
use App\OpenApi\Responses\Auth\AuthResponse;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UserController extends Controller
{
    #[OpenApi\Operation(tags: ['user'],security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthResponse::class)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    public function show()
    {
        return new UserShowResource(User::query()->find(Auth::id()));
    }
}
