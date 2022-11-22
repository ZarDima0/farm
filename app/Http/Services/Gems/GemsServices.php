<?php

namespace App\Http\Services\Gems;

use App\Models\Payments;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class GemsServices
{
    private const TYPE_WEBHOOK = 'notification';
    private const TYPE_ADD_GEM = 'replenishment';
    private const STATUS = 'pending';

    /**
     * @param int $gemAmount
     * @param int $userId
     * @return Builder|Model
     */
    public function buyGems(int $gemAmount, int $userId): Model|Builder
    {
        $response = Http::withBasicAuth(config('app.user_id_kassa'), config('app.token_kassa'))
            ->withHeaders([
                'Idempotence-Key' => uniqid('', true)
            ])
            ->post(config('app.url_kassa'), [
                'amount' => array(
                    'value' => $gemAmount,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => 'https://www.example.com/return_url',
                ),
                'capture' => true,
                'description' => 'Заказ №1',
            ]);

        $body = json_decode($response->body());

        /** @var  WalletTransactions $WalletTransactions */
        $WalletTransactions = WalletTransactions::query()->create([
            'user_id' => $userId,
            'gem_amount' => $gemAmount,
            'type' => self::TYPE_ADD_GEM,
            'external_id' => $body->id,
            'status' => self::STATUS,
        ]);

        return Payments::query()->create([
            'user_id' => $userId,
            'transactions_id' => $WalletTransactions->getId(),
            'status' => $body->status,
            'value' => $body->amount->value,
            'currency' => $body->amount->currency,
            'external_id' => $body->id,
            'confirmation_url' => $body->confirmation->confirmation_url,
            'description' => $body->description
        ]);
    }

    /**
     * @param array $NotificationsWebhook
     * @return false|string
     */
    public function webhook(array $NotificationsWebhook): bool|string
    {
        if ($NotificationsWebhook['type'] != self::TYPE_WEBHOOK) {
            return false;
        }

        $statusNotifications = $NotificationsWebhook['object']['status'];
        $idNotifications = $NotificationsWebhook['object']['id'];

        if (!isset($statusNotifications)) {
            return false;
        }

        Payments::query()->where('external_id', '=', $idNotifications)
            ->update([
                'status' => $statusNotifications
            ]);

        /** @var Payments $payments */
        $payments = Payments::query()->where('external_id', '=', $idNotifications)->first();

        WalletTransactions::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'status' => $statusNotifications
            ]);

        /** @var Wallet $wallet */
        $wallet = Wallet::query()->where('user_id', '=', $payments->getUserId())->first();

        Wallet::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'gem_amount' => (int)$wallet->getGemAmount() + (int)$payments->getValue(),
            ]);

        return response('', 200);
    }
}
