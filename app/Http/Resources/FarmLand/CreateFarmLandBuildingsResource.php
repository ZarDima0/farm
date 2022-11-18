<?php
namespace App\Http\Resources\FarmLand;

use App\Models\FarmBuilding;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateFarmLandBuildingsResource extends JsonResource
{

    /** @var FarmBuilding */
    public $resource;

    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $farmBuilding = $this->resource;

        return [
            'id' => $farmBuilding->getId(),
            'farmId' => $farmBuilding->getFarmId(),
            'buildingId' => $farmBuilding->getBuildingId(),
        ];
    }
}
