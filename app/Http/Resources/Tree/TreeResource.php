<?php
namespace App\Http\Resources\Tree;

use App\Models\Crop;
use App\Models\Tree;
use Illuminate\Http\Resources\Json\JsonResource;

class TreeResource extends JsonResource
{
    /** @var Crop */
    public $resource;
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $trees = [];
        foreach ($this->resource as $tree) {
            $trees[] = [
                'id' => $tree->id,
                'name' => $tree->getName(),
                'tiles' => $tree->getTiles(),
                'height' => $tree->getHeight(),
                'crop' =>
                    dd($tree->crop()->getPlantableType()),
            ];
        }
        return $trees;
    }
}
