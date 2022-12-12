<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\BuyPremiunRequest;
use App\Http\Resources\Shop\BuyPremiumResource;
use App\Http\Resources\Shop\HistoryResource;
use App\Http\Services\Shop\ShopServices;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * @param BuyPremiunRequest $buyPremiunRequest
     * @param ShopServices $shopServices
     * @return BuyPremiumResource
     */
    public function buyPremium(BuyPremiunRequest $buyPremiunRequest,ShopServices $shopServices)
    {
        return new BuyPremiumResource($shopServices->buyPremiun($buyPremiunRequest->getProductId(), Auth::id()));
    }

    public function history(ShopServices $shopServices): AnonymousResourceCollection
    {
        return HistoryResource::collection($shopServices->history(Auth::id()));
    }
}
