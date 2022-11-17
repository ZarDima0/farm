<?php

namespace App\Http\Resources\FarmLand;

use App\Models\FarmBuilding;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateFarmLandPlantablesResource extends JsonResource
{

    /** @var FarmBuilding */
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
            $this->resource,
        ];
    }
}
