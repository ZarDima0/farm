<?php

namespace App\Http\Services\Payment\Strategy;

use App\Http\Services\Payment\YooKassa\CreateYooKassaResponse;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        if ($body->type = 'error') {
            Log::error('Ошибка:' . $body->description);
            throw new \Exception('Ошибка:' . $body->description);
        }

        return new CreateYooKassaResponse($body);
    }
}
