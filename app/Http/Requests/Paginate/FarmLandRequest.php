<?php

namespace App\Http\Requests\Paginate;

use Illuminate\Foundation\Http\FormRequest;

class FarmLandRequest extends FormRequest
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
            //
        ];
    }

    public function getPage()
    {
        return $this->input('page');
    }
}
