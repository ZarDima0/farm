<?php
namespace App\Http\Services\Payment\DTO;

class WebhookDTO
{

    /**
     * @param string $statusNotifications
     * @param string $idNotifications
     */
    public function __construct(
        public string $statusNotifications,
        public string $idNotifications,
    )
    {
    }

    /**
     * @return string
     */
    public function getStatusNotifications(): string
    {
        return $this->statusNotifications;
    }

    /**
     * @return string
     */
    public function getIdNotifications(): string
    {
        return $this->idNotifications;
    }
}
