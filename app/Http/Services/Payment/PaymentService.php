<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\DTO\WebhookDTO;
use App\Http\Services\Payment\YooKassa\CreateResponse;
use App\Jobs\ProccessWalletReplenishment;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    private const TYPE_WEBHOOK = 'notification';

    public function createPayment(int $amount, string $currency, int $userId)
    {

        if($currency == Payment::CURRENCY_RUB) {

            $response = Http::withBasicAuth(config('app.user_id_kassa'), config('app.token_kassa'))
                ->withHeaders([
                    'Idempotence-Key' => uniqid('', true)
                ])
                ->post(config('app.url_kassa'), [
                    'amount' => array(
                        'value' => $amount,
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
            return new CreateResponse($body);
        }
    }

    /**
     * @param WebhookDTO $webhookDTO
     * @return Response|false
     */
    public function processWebhook(WebhookDTO $webhookDTO):Response|false
    {
        if ($webhookDTO->getStatusNotifications() != self::TYPE_WEBHOOK) {
            return false;
        }

        Payment::query()->where('external_id', '=', $webhookDTO->getIdNotifications())
            ->update([
                'status' => $webhookDTO->getStatusNotifications()
            ]);

        /** @var Payment $payments */
        $payments = Payment::query()->where('external_id', '=', $webhookDTO->getIdNotifications())->first();

        WalletTransaction::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'status' => $webhookDTO->getStatusNotifications()
            ]);

        /** @var Wallet $wallet */
        $wallet = Wallet::query()->where('user_id', '=', $payments->getUserId())->first();

        ProccessWalletReplenishment::dispatch(
            $payments->getUserId(),
            $wallet->getGemAmount(),
            $payments->getValue()
        );
        Wallet::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'gem_amount' => (int)$wallet->getGemAmount() + (int)$payments->getValue(),
            ]);

        return response('', 200);
    }
}
