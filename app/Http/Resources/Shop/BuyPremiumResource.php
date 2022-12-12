<?php
namespace App\Http\Resources\Shop;

use App\Models\Premium;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyPremiumResource extends JsonResource
{
    /** @var Premium */
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
            'title' => $this->resource->getName(),
        ];
    }
}
