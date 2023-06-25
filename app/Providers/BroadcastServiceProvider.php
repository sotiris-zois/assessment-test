<?php

namespace App\Providers;

use App\Events\ProductUpdated;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;

class BroadcastServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');

        Event::listen(function (ProductUpdated $event) {
            return sprintf('Broadcasted data: %s', json_encode($event->broadcastWith()));
        });

    }
}
