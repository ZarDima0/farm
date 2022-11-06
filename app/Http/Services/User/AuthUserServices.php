<?php
namespace App\Http\Services\User;

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
            'name' => $request['email'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ];
        $user = User::create($input);
        $token = $user->createToken($request['email'])->plainTextToken;
        return $token;
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
