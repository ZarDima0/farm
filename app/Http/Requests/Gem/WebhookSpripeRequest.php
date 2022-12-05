<?php

namespace App\Http\Requests\Gem;

use App\Http\Services\Payment\DTO\WebhookDTO;
use Illuminate\Foundation\Http\FormRequest;

class WebhookSpripeRequest extends FormRequest
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

    /**
     * @return array
     */
    public function getWebhookStripe(): array
    {
        return $this->all();
    }
}
