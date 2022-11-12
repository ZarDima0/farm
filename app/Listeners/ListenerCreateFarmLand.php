<?php

namespace App\Listeners;

use App\Events\EventCreateFarmLand;
use App\Models\FarmLand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerCreateFarmLand
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
     * @param  \App\Events\EventCreateFarmLand  $event
     * @return void
     */
    public function handle(EventCreateFarmLand $event)
    {
        $user = $event->user;
        return FarmLand::create([
            'user_id' =>$user->getId(),
            'name' => $user->getName(),
            'tiles' => 1000,
        ]);
    }
}
