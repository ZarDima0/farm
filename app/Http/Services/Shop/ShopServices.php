<?php

namespace App\Http\Services\Shop;

use App\Http\Services\Payment\PaymentService;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ShopServices
{
    /**
     * @param int $idProduct
     * @param int $userId
     * @return false|void
     */
    public function buyPremiun( int $idProduct, int $userId)
    {
        DB::beginTransaction();

        $shop = Shop::query()->where('product_id','=' , $idProduct)->first();

        $user = User::query()->where('id', $userId)->first();

        $wallet =  Wallet::query()->where('user_id',$userId)->first();

        if ($wallet->getGemAmount() - $shop->getCost() < 0) {
            return false;
        }

        WalletTransaction::query()->where('user_id',$userId)
            ->update([
                'type' => WalletTransaction::TYPE_WRITE_OFF,
                'status' => Payment::STATUS_SUCCEEDED,
                'gem_amount' => $shop->getCost()
            ]);

        $wallet->setGemAmount($wallet->getGemAmount() - $shop->getCost());
        $wallet->save();

        $user->setPremium(true);
        $user->setEndPremium($shop->product->getAmountDays());
        $user->save();

        DB::commit();
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function history( int $userId): Collection|array
    {
        return WalletTransaction::query()->where('user_id', $userId)->get();
    }
}
