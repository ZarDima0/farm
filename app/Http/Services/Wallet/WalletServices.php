<?php
namespace App\Http\Services\Wallet;

use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Exception;

class WalletServices
{

    /**
     * @param User $user
     * @param Shop $shop
     * @return boolean
     */
    public function writeOff ( User $user, Shop $shop)
    {
        $wallet = Wallet::query()->where('user_id', $user->getId())->first();

        if ($wallet->getGemAmount() - $shop->getCost() < 0) {
            throw new Exception('Недостаточно гемов');
        }
        WalletTransaction::query()->where('user_id',$wallet->getUserId())
            ->update([
                'type' => WalletTransaction::TYPE_WRITE_OFF,
                'status' => Payment::STATUS_SUCCEEDED,
                'gem_amount' => $shop->getCost()
            ]);

        $wallet->update([
            'gem_amount' => $wallet->getGemAmount() - $shop->getCost()
        ]);
        $wallet->save();
    }
}
