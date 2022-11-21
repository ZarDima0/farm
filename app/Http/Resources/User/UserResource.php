<?php
namespace App\Http\Resources\User;

use App\Models\FarmLand;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /** @var FarmLand */
    public $resource;
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
            'token' => $token
        ];
    }
}
