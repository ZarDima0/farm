<?php

namespace App\Http\Services\Payment\Strategy;

use App\Http\Services\Payment\Stripe\CreateStripeResponse;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class Stripe implements InterfaceStrategy
{

    /**
     * @param $valueGem
     * @return CreateStripeResponse
     * @throws ApiErrorException
     */
    public function doService($valueGem): CreateStripeResponse
    {
        $stripe = new StripeClient(config('app.secret_key'));
        $product = $stripe->products->create([
            'name' => 'Starter Subscription',
        ]);

        $price = $stripe->prices->create([
            'unit_amount' => $valueGem,
            'currency' => 'usd',
            'product' => $product['id'],
        ]);

        $sessionData = $stripe->checkout->sessions->create([
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);
        return new CreateStripeResponse($sessionData);
    }
}
