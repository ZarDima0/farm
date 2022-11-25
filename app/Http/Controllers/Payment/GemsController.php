<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gem\BuyGemsRequest;
use App\Http\Requests\Gem\WebhookRequest;
use App\Http\Resources\Gem\CreatePaymentResource;
use App\Http\Services\Gems\GemsService;
use App\Http\Services\Payment\PaymentService;
use Illuminate\Support\Facades\Auth;

class GemsController extends Controller
{
    /**
     * @param BuyGemsRequest $buyGemsRequest
     * @param GemsService $gemsServices
     * @param PaymentService $paymentService
     * @return CreatePaymentResource
     */
    public function buyGems(BuyGemsRequest $buyGemsRequest,GemsService $gemsServices, PaymentService $paymentService): CreatePaymentResource
    {
        $createdPayment = $paymentService->createPayment($buyGemsRequest->getBuyGems(),$buyGemsRequest->getBuyGemsCurrency(),Auth::id());
        return new CreatePaymentResource($gemsServices->buyGems($createdPayment, Auth::id()));
    }

    /**
     * @param WebhookRequest $request
     * @param PaymentService $paymentServices
     * @return bool|string
     */
    public function webhook(WebhookRequest $request, PaymentService $paymentServices): bool|string
    {
        return $paymentServices->processWebhook($request->getWebhook());
    }
}
