<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserRegisterCollection;
use App\Http\Resources\UserResource;
use App\Http\Services\User\AuthUserServices;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{

    /**
     * @param UserRequest $request
     * @param AuthUserServices $authUserServices
     * @return UserRegisterCollection
     */
    public function register(UserRequest $request, AuthUserServices $authUserServices):UserResource
    {
        return new UserResource($authUserServices->register($request));
    }

    /**
     * @param UserLoginRequest $request
     * @param AuthUserServices $authUserServices
     * @return UserResource
     */
    public function login(UserLoginRequest $request, AuthUserServices $authUserServices):UserResource
    {
        return new UserResource($authUserServices->login($request));
    }
}
