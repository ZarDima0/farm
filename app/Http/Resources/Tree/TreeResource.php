<?php
namespace App\Http\Resources\Tree;

use Illuminate\Http\Resources\Json\JsonResource;

class TreeResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
