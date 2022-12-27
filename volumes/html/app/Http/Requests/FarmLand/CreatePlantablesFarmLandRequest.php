<?php

namespace App\Http\Requests\FarmLand;

use App\Http\Services\FarmLand\DTO\CreatePlantFarmLandDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreatePlantablesFarmLandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'farmland_id' => 'string',
            'plantable_type' => 'string',
            'plantable_id' => 'integer',
            'count' => 'integer',
            'planted_at' => 'string',
            'harvested_at' => 'string',
        ];
    }

    public function getPlantFarmLandDTO()
    {
        return new CreatePlantFarmLandDTO(
            $this->input('farmland_id'),
            $this->input('plantable_type'),
            $this->input('plantable_id'),
            $this->input('count'),
            $this->input('planted_at'),
            $this->input('harvested_at'),
        );
    }
}
