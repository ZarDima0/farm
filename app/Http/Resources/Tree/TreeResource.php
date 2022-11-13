<?php
namespace App\Http\Resources\Tree;

use App\Models\Tree;
use Illuminate\Http\Resources\Json\JsonResource;

class TreeResource extends JsonResource
{
    /** @var Tree */
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
                'crop' => $tree->crop(),
            ];
        }
        return $trees;
    }
}
