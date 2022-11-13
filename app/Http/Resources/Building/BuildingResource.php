<?php
namespace App\Http\Resources\Building;

use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $buildings = [];
        foreach ($this->resource as $building) {
            $buildings[] = [
                'id' => $building->id,
                'name' => $building->getName(),
                'tiles' => $building->getTiles(),
            ];
        }
        return $buildings;
    }
}
