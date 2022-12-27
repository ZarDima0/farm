<?php
namespace App\Http\Controllers\Gem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gem\BuyGemsRequest;
use App\Http\Requests\Gem\WebhookRequest;
use App\Http\Requests\Gem\WebhookSpripeRequest;
use App\Http\Resources\Gem\CreatePaymentResource;
use App\Http\Services\Gem\GemService;
use App\Http\Services\Payment\PaymentService;
use App\OpenApi\RequestBodies\Gem\BuyGemsRequestBody;
use App\OpenApi\Responses\DefaultResponses\AuthorizeErrorResponse;
use App\OpenApi\Responses\DefaultResponses\ServerErrorResponse;
use App\OpenApi\Responses\FarmLand\FarmLandResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class GemController extends Controller
{

    #[OpenApi\Operation(tags: ['Gems'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: BuyGemsRequestBody::class)]
    #[OpenApi\Response(factory: FarmLandResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AuthorizeErrorResponse::class, statusCode: 401)]
    #[OpenApi\Response(factory: ServerErrorResponse::class, statusCode: 500)]
    /**
     * @param BuyGemsRequest $buyGemsRequest
     * @param GemService $gemService
     * @return CreatePaymentResource
     */
    public function buyGems(BuyGemsRequest $buyGemsRequest, GemService $gemService): CreatePaymentResource
    {
        return new CreatePaymentResource($gemService->purchaseGems($buyGemsRequest->getBuyGems(), $buyGemsRequest->getBuyGemsCurrency(), Auth::id()));
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
        return $paymentServices->processWebhookStripe($request->getStripeEvent());
    }
}
