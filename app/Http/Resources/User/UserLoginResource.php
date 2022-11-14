<?php
namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $token = $this->resource['token'];
        return [
            'token' => $token,
        ];
    }
}
