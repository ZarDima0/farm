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
        $plants = [];
        foreach ($this->resource as $plant) {
            $plants[] = [
                'id' => $plant->id,
                'name' => $plant->getName(),
                'is_perennial' => $plant->isIsPerennial(),
                'is_harvestable' => $plant->isIsHarvestable(),
                'crop' => $plant->crop(),
            ];
        }
        return $plants;
    }
}
