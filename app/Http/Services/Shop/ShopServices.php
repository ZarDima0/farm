<?php

namespace App\Http\Services\Shop;

use App\Http\Services\Payment\PaymentService;
use App\Http\Services\Wallet\WalletServices;
use App\Models\Payment;
use App\Models\Premium;
use App\Models\Shop;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as BuilderAlias;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopServices
{

    /**
     * @param int $idProduct
     * @param int $userId
     */
    public function buyPremiun(int $idProduct, int $userId)
    {
        DB::beginTransaction();

        $shop = Shop::query()->where('product_id', '=', $idProduct)->first();

        $user = User::query()->where('id', $userId)->first();

        $walletServices = new WalletServices();
        $walletServices->writeOff($user, $shop);

        $userUpdatePremium = function ($user, $shop, $date) {
            $user->setEndPremium($date->addDays($shop->product->amount_days));
            $user->setPremium(true);
            $user->save();
        };

        $date = Carbon::today();
        if ($user->getEndPremium() == null) {
            $userUpdatePremium($user, $shop, $date);
        }
        $userUpdatePremium($user, $shop, $date);
        DB::commit();
        return $user;
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function history(int $userId): Collection|array
    {
        return WalletTransaction::query()
            ->where('user_id', $userId)
            ->where('type', 'buy')
            ->where('status', 'succeeded')
            ->get();
    }
}
