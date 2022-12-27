<?php
namespace App\Http\Resources\Building;

use App\Models\Building;
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
        /**
         * @var Building $Building
         */
        $buildings = $this->resource;

        return [
            'id' => $buildings->getId(),
            'name' => $buildings->getName(),
            'tiles' => $buildings->getTiles(),
        ];
    }
}
