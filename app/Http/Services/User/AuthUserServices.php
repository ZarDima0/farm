<?php
namespace App\Http\Services\User;

use App\Events\EventCreateFarmLand;
use App\Events\EventCreateWallet;
use App\Http\Services\User\DTO\UserDTO;
use App\Models\User;
use App\Models\Wallet;

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

        /** @var  User $user */
        $user = User::query()->create($input);

        event(new EventCreateFarmLand($user));

        Wallet::query()->create([
            'user_id' =>$user->getId(),
            'gem_amount' => 0,
        ]);

        $token = $user->createToken($userDTO->getEmail())->plainTextToken;
        return [
            'token' => $token,
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




















































