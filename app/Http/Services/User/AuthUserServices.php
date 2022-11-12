<?php
namespace App\Http\Services\User;

use App\Events\EventCreateFarmLand;
use App\Models\User;

class AuthUserServices
{
    /**
     * @param $request
     * @return mixed
     */
    public function register($request)
    {
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ];
        $user = User::create($input);

        $createFarmLand = event(new EventCreateFarmLand($user));

        $token = $user->createToken($request['email'])->plainTextToken;
        return [
            'farmLand' => $createFarmLand,
            'token' => $token
        ];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function login($request)
    {
        $user = User::where('email', $request['email'])->first();
        $token = $user->createToken('app-token')->plainTextToken;
        $user->token = $token;
        return $user;
    }
}




















































