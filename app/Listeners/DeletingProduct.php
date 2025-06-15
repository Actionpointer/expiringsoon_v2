<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\Like;
use App\Models\Order;
use App\Models\Advert;
use App\Models\Feature;
use App\Models\OrderItem;
use App\Events\DeleteProduct;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletingProduct
{
    use OptimizationTrait;
    
    public function __construct()
    {
        //
    }

    public function handle(DeleteProduct $event)
    {
        $product_id = $event->product->id;
        Advert::where('advertable_id',$product_id)->where('advertable_type','App\Models\Product')->delete();
        Feature::where('product_id',$product_id)->delete();
        Cart::where('product_id',$product_id)->delete();
        Like::where('product_id',$product_id)->delete();
        Order::whereHas('items',function($query) use($product_id){
            $query->where('product_id',$product_id);
        })->delete();
        OrderItem::where('product_id',$product_id)->delete();
    }
}
