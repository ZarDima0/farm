<?php

namespace App\Http\Requests\User;


use App\Http\Services\User\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required','string','email','max:255',
            'password' => 'required','string', 'min:8'
        ];
    }

    /**
     * @return UserDTO
     */
    public function getLoginUserDTO(): UserDTO
    {
        return (new UserDTO())
            ->setEmail($this->input('email'))
            ->setPassword($this->input('password'));
    }
}
