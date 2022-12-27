<?php

namespace App\Http\Resources\Gem;

use App\Helpers\Helpers;
use App\Models\FarmBuilding;
use App\Models\FarmLandPlantable;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

class CreatePaymentResource extends JsonResource
{

    /** @var Payment */
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
            'id' => $this->resource->getId(),
            'userId' => $this->resource->getUserId(),
            'transactionsId' => $this->resource->getTransactionsId(),
            'status' => $this->resource->getStatus(),
            'value' => $this->resource->getValue(),
            'confirmationUrl' => $this->resource->getConfirmationUrl(),
            'description' => $this->resource->getDescription(),
        ];
    }
}
