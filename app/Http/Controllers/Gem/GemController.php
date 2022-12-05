<?php
namespace App\Http\Controllers\Gem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gem\BuyGemsRequest;
use App\Http\Requests\Gem\WebhookRequest;
use App\Http\Requests\Gem\WebhookSpripeRequest;
use App\Http\Resources\Gem\CreatePaymentResource;
use App\Http\Services\Gem\GemService;
use App\Http\Services\Payment\PaymentService;
use Exception;
use Illuminate\Support\Facades\Auth;

class GemController extends Controller
{
    /**
     * @param BuyGemsRequest $buyGemsRequest
     * @param PaymentService $paymentService
     * @return CreatePaymentResource
     * @throws Exception
     */
    public function buyGems(BuyGemsRequest $buyGemsRequest, PaymentService $paymentService): CreatePaymentResource
    {
        return new CreatePaymentResource($paymentService->createPayment($buyGemsRequest->getBuyGems(),$buyGemsRequest->getBuyGemsCurrency(),Auth::id()));
    }

    /**
     * @param WebhookRequest $request
     * @param PaymentService $paymentServices
     * @return bool|string
     */
    public function yooKassaWebhook(WebhookRequest $request, PaymentService $paymentServices): bool|string
    {
        return $paymentServices->processWebhook($request->getWebhook());
    }

    /**
     * @param WebhookSpripeRequest $request
     * @param PaymentService $paymentServices
     * @return bool|string
     */
    public function stripeWebhook(WebhookSpripeRequest $request, PaymentService $paymentServices): bool|string
    {
        return $paymentServices->processWebhookStripe($request->getWebhookStripe());
    }
}
