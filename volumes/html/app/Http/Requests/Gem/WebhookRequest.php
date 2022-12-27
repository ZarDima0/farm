<?php

namespace App\Http\Requests\Gem;

use App\Http\Services\Payment\DTO\WebhookDTO;
use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
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
    public function getNotificationsWebhook(): array
    {
        return $this->all();
    }

    /**
     * @return WebhookDTO
     */
    public function getWebhook(): WebhookDTO
    {
        return new WebhookDTO(
            $this->input('object.status'),
            $this->input('object.id'),
        );
    }
}
