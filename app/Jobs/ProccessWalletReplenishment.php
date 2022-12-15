<?php /** @noinspection ALL */

namespace App\Jobs;

use App\Http\Services\Payment\DTO\WebhookDTO;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProccessWalletReplenishment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct(private string $externalId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::critical($this->externalId);
        Payment::query()->where('external_id', '=', $this->externalId)
            ->update([
                'status' => Payment::STATUS_SUCCEEDED,
            ]);

        /** @var Payment $payments */
        $payments = Payment::query()->where('external_id', '=', $this->externalId)->first();

        WalletTransaction::query()->where('user_id', '=', $payments->getUserId())
            ->update([
                'status' => Payment::STATUS_SUCCEEDED
            ]);

        /** @var Wallet $wallet */
        $wallet = Wallet::query()->where('user_id', '=', $payments->getUserId())->first();

        Wallet::query()->where('user_id', '=', $wallet->getUserId())
            ->update([
                'gem_amount' => $wallet->getGemAmount() + $payments->getValue(),
            ]);
    }
}
