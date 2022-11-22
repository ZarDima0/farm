<?php

namespace App\Providers;

use App\Events\EventCreateFarmLand;
use App\Events\EventCreateWallet;
use App\Listeners\ListenerCreateFarmLand;
use App\Listeners\ListenerCreateWallet;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        EventCreateFarmLand::class => [
            ListenerCreateFarmLand::class
        ],
        EventCreateWallet::class => [
            ListenerCreateWallet::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
