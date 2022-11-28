<?php

namespace App\Http\Services\Payment\YooKassa;

class CreateResponse
{
    public string $status;
    public int $value;
    public string $currency;
    public string $externalId;
    public string $confirmationUrl;
    public string $description;

    /**
     * @param $body
     */
    public function __construct($body)
    {
        $this->status = $body->status;
        $this->value = $body->amount->value;
        $this->currency = $body->amount->currency;
        $this->externalId = $body->id;
        $this->confirmationUrl = $body->confirmation->confirmation_url;
        $this->description = $body->description;
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
    public function getExternalId(): string
    {
        return $this->externalId;
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
