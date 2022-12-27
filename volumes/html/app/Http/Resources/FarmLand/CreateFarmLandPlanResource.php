<?php

namespace App\Http\Resources\FarmLand;

use App\Helpers\Helpers;
use App\Models\FarmBuilding;
use App\Models\FarmLandPlantable;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateFarmLandPlanResource extends JsonResource
{

    /** @var FarmLandPlantable */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'farmland_id' => $this->resource->getFarmlandId(),
            'plantable_type' => Helpers::convertMorpf($this->resource->getPlantableType()),
            'plantable_id' => $this->resource->getPlantableId(),
            'count' => $this->resource->getCount(),
            'planted_at' => $this->resource->getPlantedAt(),
            'harvested_at' => $this->resource->getHarvestedAt(),
            'crop' =>[
                'id' => $this->resource->plantable->getId(),
                'name' => $this->resource->plantable->getName(),
                'tiles' => $this->resource->plantable->getTiles(),
            ]
        ];
    }
}
