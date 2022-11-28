<?php
namespace App\Http\Controllers\Gem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gem\BuyGemsRequest;
use App\Http\Requests\Gem\WebhookRequest;
use App\Http\Resources\Gem\CreatePaymentResource;
use App\Http\Services\Gem\GemService;
use App\Http\Services\Payment\PaymentService;
use Illuminate\Support\Facades\Auth;

class GemController extends Controller
{
    /**
     * @param BuyGemsRequest $buyGemsRequest
     * @param GemService $gemsServices
     * @param PaymentService $paymentService
     * @return CreatePaymentResource
     */
    public function buyGems(BuyGemsRequest $buyGemsRequest,GemService $gemsServices, PaymentService $paymentService): CreatePaymentResource
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
