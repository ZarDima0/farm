<?php
namespace App\Http\Resources\Plant;

use App\Helpers\Helpers;
use App\Models\Crop;
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
        /**
         * @var Crop $crop
         */
        $crop = $this->resource->crop;
        return [
            'id' => $this->resource->getId(),
            'name' => $this->resource->getName(),
            'isPerennial' => $this->resource->isIsPerennial(),
            'isHarvestable' => $this->resource->isIsHarvestable(),
            'crop' => [
                'plantableType' => Helpers::convertMorpf($crop->getPlantableType()),
                'name' => $crop->name,
                'yieldPerTile' => $crop->yield_per_tile,
            ]
        ];
    }
}
