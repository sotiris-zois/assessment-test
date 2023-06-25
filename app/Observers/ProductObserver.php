<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use App\Socket\WebSocketServer;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    public function updated(Product $product): void
    {
        $message = json_encode(['event' => 'product-updated', 'data' => $product]);

     }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
         // or send a HTTP request to a WebSocket server.
    }
}
