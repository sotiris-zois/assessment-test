<?php

namespace App\Listeners;

use App\Events\ProductUpdated;



class ProductUpdatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductUpdated $event): void
    {
        $product = $event->product;
        echo json_encode($product);
    }
}
