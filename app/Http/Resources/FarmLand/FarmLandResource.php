<?php
namespace App\Http\Resources\FarmLand;

use App\Models\FarmLand;
use Illuminate\Http\Resources\Json\JsonResource;

class FarmLandResource extends JsonResource
{

    /** @var FarmLand */
    public $resource;

    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $farmLand = $this->resource;

        return [
            'id' => $farmLand->getId(),
            'name' => $farmLand->getName(),
            'tiles' => $farmLand->getTiles(),
        ];
    }
}
