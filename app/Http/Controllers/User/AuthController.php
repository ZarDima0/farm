<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\AuthUserServices;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{

    /**
     * @param UserRequest $request
     * @param AuthUserServices $authUserServices
     * @return UserResource
     */
    public function register(UserRequest $request, AuthUserServices $authUserServices):UserResource
    {
        return new UserResource($authUserServices->register($request->getUserRegisterDTO()));
    }

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
