<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\AuthUserServices;
use App\OpenApi\RequestBodies\Auth\LoginRequestBody;
use App\OpenApi\RequestBodies\Auth\RegisterRequestBody;
use App\OpenApi\Responses\Auth\AuthResponse;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use Illuminate\Routing\Controller;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AuthController extends Controller
{
    #[OpenApi\Operation(tags: ['auth'])]
    #[OpenApi\RequestBody(factory: RegisterRequestBody::class)]
    #[OpenApi\Response(factory: AuthResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param UserRequest $request
     * @param AuthUserServices $authUserServices
     * @return UserResource
     */
    public function register(UserRequest $request, AuthUserServices $authUserServices):UserResource
    {
        return new UserResource($authUserServices->register($request->getUserRegisterDTO()));
    }

    #[OpenApi\Operation(tags: ['auth'])]
    #[OpenApi\RequestBody(factory: LoginRequestBody::class)]
    #[OpenApi\Response(factory: AuthResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param UserLoginRequest $request
     * @param AuthUserServices $authUserServices
     * @return UserLoginResource
     */
    public function login(UserLoginRequest $request, AuthUserServices $authUserServices): UserLoginResource
    {
        return new UserLoginResource($authUserServices->login($request->getLoginUserDTO()));
    }
}
