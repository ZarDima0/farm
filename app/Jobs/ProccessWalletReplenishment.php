<?php /** @noinspection ALL */

namespace App\Jobs;

use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProccessWalletReplenishment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $gemAmount;
    private $value;

    /**
     * Create a new job instance.
     *
     * @param $userId
     * @param $gemAmount
     * @param $value
     */
    public function __construct($userId, $gemAmount, $value)
    {
        $this->userId = $userId;
        $this->gemAmount = $gemAmount;
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Wallet::query()->where('user_id', '=', $this->userId)
            ->update([
                'gem_amount' => (int)$this->gemAmount + (int)$this->value,
            ]);
    }
}
