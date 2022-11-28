<?php

namespace App\Http\Requests\Gem;

use Illuminate\Foundation\Http\FormRequest;

class BuyGemsRequest extends FormRequest
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
            'gemAmount' => 'integer',
            'currency' => 'string',
        ];
    }

    public function getBuyGems()
    {
        return $this->input('gemAmount');
    }

    public function getBuyGemsCurrency()
    {
        return $this->input('currency');
    }
}
