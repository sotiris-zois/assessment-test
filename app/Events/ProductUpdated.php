<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use App\Models\Product;

class ProductUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function broadcastWhen()
    {
        return true;
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->product,
        ];
    }

    public function broadcastOn()
    {
        return ['product-updated'];
    }

}
