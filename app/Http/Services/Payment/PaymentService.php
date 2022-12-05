<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Gem\GemService;
use App\Http\Services\Payment\DTO\WebhookDTO;
use App\Http\Services\Payment\Strategy\Context;
use App\Http\Services\Payment\Strategy\Stripe;
use App\Http\Services\Payment\Strategy\YooKassa;
use App\Jobs\ProccessWalletReplenishment;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class PaymentService
{
    private const TYPE_WEBHOOK = 'notification';

    /**
     * @param int $amount
     * @param string $currency
     * @throws Exception
     */
    public function createPayment(int $amount, string $currency, int $userId): Model|Builder
    {
        $strategy = match ($currency) {
            Payment::CURRENCY_RUB => new YooKassa(),
            Payment::CURRENCY_USD => new Stripe(),
            default => throw new Exception('Стратегия не найдена'),
        };

        $context = new Context($strategy);

        return (new GemService())->buyGems($context->startService($amount), $userId, $strategy);
    }

    /**
     * @param WebhookDTO $webhookDTO
     * @return Response|false
     */
    public function processWebhook(WebhookDTO $webhookDTO): Response|false
    {
        Payment::query()->where('external_id', '=', $webhookDTO->getIdNotifications())
            ->update([
                'status' => Payment::STATUS_SUCCEEDED,
            ]);

        /** @var Payment $payments */
        $payments = Payment::query()->where('external_id', '=', $webhookDTO->getIdNotifications())->first();

        WalletTransaction::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'status' => Payment::STATUS_SUCCEEDED
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

    /**
     * @param $webhook
     * @return Application|ResponseFactory|Response|void
     */
    public function processWebhookStripe($webhook)
    {
        \Stripe\Stripe::setApiKey(config('app.secret_key'));

        $event = null;

        try {
            $event = \Stripe\Event::constructFrom($webhook);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }
        switch ($event->type) {
            case 'checkout.session.completed':
                $paymentIntent = $event->data->object;

                Payment::query()->where('external_id', '=', $paymentIntent->id)
                    ->update([
                        'status' => Payment::STATUS_SUCCEEDED
                    ]);
                /** @var Payment $payments */
                $payments = Payment::query()->where('external_id', '=', $paymentIntent->id)->first();

                WalletTransaction::query()->where('user_id', '=', $payments->id)
                    ->update([
                        'status' => Payment::STATUS_SUCCEEDED
                    ]);

                /** @var Wallet $wallet */
                $wallet = Wallet::query()->where('user_id', '=', $payments->user_id)->first();

                ProccessWalletReplenishment::dispatch(
                    $payments->getUserId(),
                    $wallet->gem_amount,
                    $payments->getValue()
                );
                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }
}
