<?php
namespace App\Http\Resources;

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
        $farmLand = $this->resource['farmLand'][0];

        return [
            'farmLand' => [
                'userId' => $farmLand->getId(),
                'name' => $farmLand->getName(),
                'tiles' => $farmLand->getTiles(),
            ],
            'token' => $token
        ];
    }
}
