<?php

namespace App\Listeners;

use App\Events\EventCreateFarmLand;
use App\Events\EventCreateWallet;
use App\Models\FarmLand;
use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerCreateWallet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventCreateWallet  $event
     * @return void
     */
    public function handle(EventCreateWallet $event)
    {
        $user = $event->getUser();
        Wallet::query()->create([
            'user_id' =>$user->getId(),
            'gem_amount' => 0,
        ]);
    }
}
