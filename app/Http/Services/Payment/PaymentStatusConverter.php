<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\Strategy\Stripe;
use App\Http\Services\Payment\Strategy\YooKassa;
use App\Models\Payment;

class PaymentStatusConverter
{
    public static function convert(string $externalStatus, string $strategyClass): string
    {
        return match($strategyClass) {
            YooKassa::class => static::convertYooKassa($externalStatus),
            Stripe::class => static::convertStripe($externalStatus),
        };
    }

    private static function convertYooKassa(string $externalStatus): string
    {
        return match($externalStatus) {
            'success' => Payment::STATUS_SUCCEEDED,
            'pending' => Payment::STATUS_PENDING,
        };
    }

    private static function convertStripe(string $externalStatus): string
    {
        return match($externalStatus) {
            'checkout.session.completed' => Payment::STATUS_SUCCEEDED,
        };
    }
}
