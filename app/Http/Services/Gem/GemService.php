<?php

namespace App\Http\Services\Gem;

use App\Http\Services\Payment\YooKassa\CreateYooKassaResponse;
use App\Models\Payment;
use App\Models\WalletTransaction;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GemService
{

    /**
     * @param  $createdPayment
     * @param $userId
     * @param $strategy
     * @return Model|Builder
     */
    public function buyGems($createdPayment, $userId, $strategy): Model|Builder
    {
        /** @var  WalletTransaction $walletTransaction */
        $walletTransaction = WalletTransaction::query()->create([
            'user_id' => $userId,
            'gem_amount' =>$createdPayment->getValue(),
            'type' => WalletTransaction::TYPE_ADD_GEM,
            'external_id' => $createdPayment->getExternalId(),
            'status' => Payment::STATUS_PENDING,
        ]);

        return Payment::query()->create([
            'user_id' => $userId,
            'transactions_id' => $walletTransaction->getId(),
            'status' => $createdPayment->getStatus(),
            'value' => $createdPayment->getValue(),
            'currency' => $createdPayment->getCurrency(),
            'external_id' => $createdPayment->getExternalId(),
            'confirmation_url' => $createdPayment->getConfirmationUrl(),
            'description' => $createdPayment->getDescription() ?? null,
            'strategy' => get_class($strategy),
        ]);
    }
}
