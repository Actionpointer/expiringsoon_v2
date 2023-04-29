<?php

namespace App\Listeners;

use App\Events\DeleteProduct;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletingProduct
{
    use OptimizationTrait;
    
    public function __construct()
    {
        //
    }

    public function handle(DeleteProduct $event)
    {
        $event->product->adverts->delete();
        $event->product->carts->delete();
        $event->product->likes->delete();
        $event->product->orders->each(function($item){
            $item->order->delete();
        });
        $event->product->orders->delete();
    }
}
