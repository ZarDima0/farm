<?php

namespace App\Http\Requests\FarmLand;

use App\Http\Services\FarmLand\DTO\CreateBuildingFarmLandDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateBuildingFarmLandRequest extends FormRequest
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
            'building_id' => 'integer',
        ];
    }

    /**
     * @return CreateBuildingFarmLandDTO
     */
    public function getCreateBuilderDTO(): CreateBuildingFarmLandDTO
    {
        return new CreateBuildingFarmLandDTO(
            $this->input('building_id'),
        );
    }
}
