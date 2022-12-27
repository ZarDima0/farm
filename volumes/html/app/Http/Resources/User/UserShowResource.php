<?php
namespace App\Http\Resources\User;

use App\Models\FarmLand;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
{
    /** @var User */
    public $resource;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->resource->getId(),
            'name' => $this->resource->getName(),
            'email' => $this->resource->getEmail(),
            'premium' => $this->resource->isPremium(),
            'end_premium' => $this->resource->getEndPremium(),
        ];
    }
}
