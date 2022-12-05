<?php

namespace App\Http\Resources\Farmland;

use App\Helpers\Helpers;
use App\Models\FarmLandPlantable;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFarmLandPlantResource extends JsonResource
{
    /**
     * @var FarmLandPlantable
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $farmLandPlantable = $this->resource;
        return [
            'id' => $farmLandPlantable->getId(),
            'farmlandId' => $farmLandPlantable->getFarmlandId(),
            'plantable_type' => Helpers::convertMorpf($farmLandPlantable->getPlantableType()),
            'plantable_id' => $farmLandPlantable->getPlantableId(),
            'count' => $farmLandPlantable->getCount(),
            'planted_at' => Helpers::parseCarbon($farmLandPlantable->getPlantedAt()),
            'harvested_at' =>Helpers::parseCarbon($farmLandPlantable->getHarvestedAt()),
            'crop' =>[
                'id' => $farmLandPlantable->plantable->getId(),
                'name' => $farmLandPlantable->plantable->getName(),
                'tiles' => $farmLandPlantable->plantable->getTiles(),
            ]
        ];
    }
}
