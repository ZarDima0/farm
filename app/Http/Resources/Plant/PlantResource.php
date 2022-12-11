<?php
namespace App\Http\Resources\Plant;

use App\Models\Plant;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /** @var Plant */
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
            'is_perennial' => $this->resource->isIsPerennial(),
            'is_harvestable' => $this->resource->isIsHarvestable(),
            'crop' => $this->resource->crop(),
        ];
    }
}
