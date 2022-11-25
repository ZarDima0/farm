<?php

namespace App\Http\Services\Gems;

use App\Http\Services\Payment\YooKassa\CreateResponse;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class GemsService
{

    /**
     * @param CreateResponse $createdPayment
     * @param $userId
     * @return Model|Builder
     */
    public function buyGems(CreateResponse $createdPayment, $userId): Model|Builder
    {
        /** @var  WalletTransaction $walletTransaction */
        $walletTransaction = WalletTransaction::query()->create([
            'user_id' => $userId,
            'gem_amount' =>$createdPayment->getValue(),
            'type' => WalletTransaction::TYPE_ADD_GEM,
            'external_id' => $createdPayment->getExternalId(),
            'status' => Payment::STATUS,
        ]);

        return Payment::query()->create([
            'user_id' => $userId,
            'transactions_id' => $walletTransaction->getId(),
            'status' => $createdPayment->getStatus(),
            'value' => $createdPayment->getValue(),
            'currency' => $createdPayment->getCurrency(),
            'external_id' => $createdPayment->getExternalId(),
            'confirmation_url' => $createdPayment->getConfirmationUrl(),
            'description' => $createdPayment->getDescription()
        ]);
    }
}
