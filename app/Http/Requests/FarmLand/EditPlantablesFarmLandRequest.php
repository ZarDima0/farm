<?php

namespace App\Http\Requests\FarmLand;

use App\Http\Services\FarmLand\DTO\EditPlantablesFarmLandDTO;
use Illuminate\Foundation\Http\FormRequest;

class EditPlantablesFarmLandRequest extends FormRequest
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
            'farmland_id' => 'integer',
            'plantable_type' => 'string',
            'plantable_id' => 'integer',
            'count' => 'integer',
            'planted_at' => 'string',
            'harvested_at' => 'string',
        ];
    }

    /**
     * @return EditPlantablesFarmLandDTO
     */
    public function getPlantFarmLandDTO():EditPlantablesFarmLandDTO
    {
        return new EditPlantablesFarmLandDTO(
            $this->input('farmland_id'),
            $this->input('plantable_type'),
            $this->input('plantable_id'),
            $this->input('count'),
            $this->input('planted_at'),
            $this->input('harvested_at'),
        );
    }
}
