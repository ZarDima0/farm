<?php

namespace App\Http\Services\Payment\Stripe;

class CreateStripeResponse
{
    public string $externalId;
    public string $status;
    public int $value;
    public string $currency;
    public string $confirmationUrl;
    public string $description;

    public function __construct($body)
    {
        $this->status = $body->object;
        $this->externalId = $body->id;
        $this->value = $body->amount_total;
        $this->currency = $body->currency;
        $this->confirmationUrl = $body->url;
        $this->description = 'Описание';
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getConfirmationUrl(): string
    {
        return $this->confirmationUrl;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
