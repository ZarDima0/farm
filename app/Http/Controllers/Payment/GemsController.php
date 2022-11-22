<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gem\BuyGemsRequest;
use App\Http\Requests\Gem\WebhookRequest;
use App\Http\Resources\Gem\CreatePaymentResource;
use App\Http\Services\Gems\GemsServices;
use Illuminate\Support\Facades\Auth;

class GemsController extends Controller
{
    /**
     * @param BuyGemsRequest $buyGemsRequest
     * @param GemsServices $paymentServices
     * @return CreatePaymentResource
     */
    public function buyGems(BuyGemsRequest $buyGemsRequest,GemsServices $paymentServices): CreatePaymentResource
    {
        return new CreatePaymentResource($paymentServices->buyGems($buyGemsRequest->getBuyGems(), Auth::id()));
    }

    /**
     * @param WebhookRequest $request
     * @param GemsServices $paymentServices
     * @return bool|string
     */
    public function webhook(WebhookRequest $request, GemsServices $paymentServices): bool|string
    {
        return $paymentServices->webhook($request->getNotificationsWebhook());
    }
}
