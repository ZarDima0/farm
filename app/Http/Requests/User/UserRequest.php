<?php

namespace App\Http\Requests\User;

use App\DTO\User\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' =>'required','string',
            'email' => 'required','string','email','max:255',
            'password' => 'required','string', 'min:8'
        ];
    }

    public function getUserRegisterDTO():UserDTO
    {
        return (new UserDTO)
            ->setName($this->input('name'))
            ->setEmail($this->input('email'))
            ->setPassword($this->input('password'));
    }
}
