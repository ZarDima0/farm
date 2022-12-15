<?php
namespace App\Http\Resources\Shop;

use App\Models\Premium;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyPremiumResource extends JsonResource
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
            'premium' => $this->resource->isPremium(),
            'endPremium' => $this->resource->getEndPremium(),
        ];
    }
}
