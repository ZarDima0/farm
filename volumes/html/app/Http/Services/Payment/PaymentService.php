<?php

namespace App\Http\Services\Payment;

use App\Http\Requests\Gem\WebhookSpripeRequest;
use App\Http\Services\Payment\DTO\WebhookDTO;
use App\Http\Services\Payment\Strategy\Context;
use App\Http\Services\Payment\Strategy\Stripe;
use App\Http\Services\Payment\Strategy\YooKassa;
use App\Jobs\ProccessWalletReplenishment;
use App\Models\Payment;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    private const TYPE_WEBHOOK = 'notification';

    /**
     * @param int $amount
     * @param string $currency
     * @param WalletTransaction $walletTransaction
     * @return Payment|Model
     * @throws Exception
     */
    public function createPayment(int $amount, string $currency, WalletTransaction $walletTransaction): Payment|Model
    {
        $strategy = match ($currency) {
            Payment::CURRENCY_RUB => new YooKassa(),
            Payment::CURRENCY_USD => new Stripe(),
            default => throw new Exception('Стратегия не найдена'),
        };

        $context = new Context($strategy);
        $externalPayment = $context->startService($amount);

        return Payment::query()->create([
            'user_id' => $walletTransaction->getUserId(),
            'transactions_id' => $walletTransaction->getId(),
            'status' => PaymentStatusConverter::convert($externalPayment->getStatus(), get_class($strategy)),
            'value' => $amount,
            'currency' => $currency,
            'external_id' => $externalPayment->getExternalId(),
            'confirmation_url' => $externalPayment->getConfirmationUrl(),
            'description' => $externalPayment->getDescription() ?? null,
            'strategy' => get_class($strategy),
        ]);
    }

    /**
     * @param WebhookDTO $webhookDTO
     * @return Response|false
     */
    public function processWebhook(WebhookDTO $webhookDTO): Response|false
    {
        Log::debug($webhookDTO->getIdNotifications());
        ProccessWalletReplenishment::dispatch($webhookDTO->getIdNotifications());

        return response('', 200);
    }

    /**
     * @param WebhookSpripeRequest $event
     * @return Response
     */
    public function processWebhookStripe(WebhookSpripeRequest $event): Response
    {
        \Stripe\Stripe::setApiKey(config('app.secret_key'));

        switch ($event->type) {
            case 'checkout.session.completed':
                $paymentIntent = $event->data->object;
                ProccessWalletReplenishment::dispatch($paymentIntent->id);
                break;
            default:
                Log::critical('Received unknown event type ' . $event->type);
        }

        return response('', 200);
    }
}
