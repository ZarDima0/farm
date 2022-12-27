<?php

namespace App\Http\Services\Gem;

use App\Http\Services\Payment\PaymentService;
use App\Models\Payment;
use App\Models\WalletTransaction;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GemService
{
    public function purchaseGems(int $amount, string $currency, int $userId): Payment
    {
        DB::beginTransaction();

        /** @var  WalletTransaction $walletTransaction */
        $walletTransaction = WalletTransaction::query()->create([
            'user_id' => $userId,
            'gem_amount' => $amount,
            'type' => WalletTransaction::TYPE_ADD_GEM,
            'status' => Payment::STATUS_PENDING,
        ]);

        $payment = (new PaymentService())->createPayment($amount, $currency, $walletTransaction);

        DB::commit();

        return $payment;
    }

}
