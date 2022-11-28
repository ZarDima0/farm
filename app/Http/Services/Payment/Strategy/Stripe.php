<?php

namespace App\Http\Services\Payment\Strategy;

use App\Http\Services\Payment\Stripe\CreateResponse;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class Stripe implements InterfaceStrategy
{

    /**
     * @param $valueGem
     * @return CreateResponse
     * @throws ApiErrorException
     */
    public function doService($valueGem): CreateResponse
    {
        $stripe = new StripeClient(config('app.secret_key'));
        $product = $stripe->products->create([
            'name' => 'Starter Subscription',
            'description' => '$12/Month subscription',
        ]);
        $price = $stripe->prices->create([
            'unit_amount' => $valueGem,
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'],
            'product' => $product['id'],
        ]);
        $responce = $stripe->checkout->sessions->create([
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 2,
                ],
            ],
            'mode' => 'subscription',
        ]);

        dd($responce);
        return new CreateResponse($responce);
    }
}
