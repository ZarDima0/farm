<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\DTO\WebhookDTO;
use App\Http\Services\Payment\Strategy\Context;
use App\Http\Services\Payment\Strategy\InterfaceStrategy;
use App\Http\Services\Payment\Strategy\Stripe;
use App\Http\Services\Payment\Strategy\YooKassa;
use App\Jobs\ProccessWalletReplenishment;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class PaymentService
{
    private const TYPE_WEBHOOK = 'notification';

    /**
     * @param int $amount
     * @param string $currency
     * @throws Exception
     */
    public function createPayment(int $amount, string $currency)
    {
        $strategy = match ($currency) {
            Payment::CURRENCY_RUB => new YooKassa(),
            Payment::CURRENCY_USD => new Stripe(),
            default => throw new Exception('Стратегия не найдена'),
        };
        $context = new Context($strategy);

        /** @var Context $context */
        return $context->startService($amount);
    }

    /**
     * @param WebhookDTO $webhookDTO
     * @return Response|false
     */
    public function processWebhook(WebhookDTO $webhookDTO): Response|false
    {
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

        return response('', 200);
    }
}
