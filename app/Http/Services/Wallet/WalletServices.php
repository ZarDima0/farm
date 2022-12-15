<?php
namespace App\Http\Services\Wallet;

use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;

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
            return false;
        }
        WalletTransaction::query()->where('user_id',$wallet->getUserId())
            ->update([
                'type' => WalletTransaction::TYPE_WRITE_OFF,
                'status' => Payment::STATUS_SUCCEEDED,
                'gem_amount' => $shop->getCost()
            ]);

        WalletTransaction::query()
            ->create([
                'user_id' => $user->getId(),
                'type' => WalletTransaction::TYPE_BUY,
                'status' => Payment::STATUS_SUCCEEDED,
                'gem_amount' => $shop->getCost()
            ]);

        $wallet->update([
            'gem_amount' => $wallet->getGemAmount() - $shop->getCost()
        ]);
        $wallet->save();

        if ($wallet) {
            return  true;
        }
    }
}
