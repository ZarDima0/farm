<?php

namespace App\Http\Services\Payment\Strategy;

use App\Http\Services\Payment\YooKassa\CreateYooKassaResponse;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class YooKassa implements InterfaceStrategy
{
    public function doService(int $valueGem)
    {
        $response = Http::withBasicAuth(config('app.user_id_kassa'), config('app.token_kassa'))
            ->withHeaders([
                'Idempotence-Key' => uniqid('', true)
            ])
            ->post(config('app.url_kassa'), [
                'amount' => array(
                    'value' => $valueGem,
                    'currency' => Payment::CURRENCY_RUB,
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => 'https://www.example.com/return_url',
                ),
                'capture' => true,
                'description' => 'Заказ №1',
            ]);
        $body = json_decode($response->body());

        return new CreateYooKassaResponse($body);
    }
}
