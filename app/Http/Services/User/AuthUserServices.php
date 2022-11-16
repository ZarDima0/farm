<?php
namespace App\Http\Services\User;

use App\Events\EventCreateFarmLand;
use App\Http\Services\User\DTO\UserDTO;
use App\Models\User;

class AuthUserServices
{

    /**
     * @param UserDTO $userDTO
     * @return array
     */
    public function register(UserDTO $userDTO)
    {
        $input = [
            'name' => $userDTO->getName(),
            'email' => $userDTO->getEmail(),
            'password' => $userDTO->getPassword(),
        ];
        $user = User::query()->create($input);

        $createFarmLand = event(new EventCreateFarmLand($user));

        $token = $user->createToken($userDTO->getEmail())->plainTextToken;
        return [
            'farmLand' => $createFarmLand,
            'token' => $token
        ];
    }

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function login(UserDTO $userDTO)
    {
        $user = User::where('email', $userDTO->getEmail())->first();
        $token = $user->createToken('app-token')->plainTextToken;
        $user->token = $token;
        return $user;
    }
}




















































