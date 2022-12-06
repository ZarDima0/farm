<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\Strategy\YooKassa;
use App\Models\Payment;

class PaymentStatusConverter
{
    public static function convert(string $externalStatus, string $strategyClass): string
    {
        return match($strategyClass) {
            YooKassa::class => static::convertYooKassa($externalStatus),
        };
    }

    private static function convertYooKassa(string $externalStatus): string
    {
        return match($externalStatus) {
            'success' => Payment::STATUS_SUCCEEDED,
        };
    }
}
