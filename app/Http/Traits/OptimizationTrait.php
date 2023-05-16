<?php
namespace App\Http\Traits;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Http\Traits\CartTrait;



trait OptimizationTrait
{
    use CartTrait;
    
    protected function resetShops(User $user) {
        $allowed_shops = $user->max_shops;
        Shop::where('user_id',$user->id)->update(['status'=> false]);
        Shop::where('user_id',$user->id)->orderBy('created_at','asc')->take($allowed_shops)->update(['status'=> true]);
    }

    protected function resetProducts(User $user) {
        $allowed_products = $user->max_products;
        Product::whereIn('shop_id',$user->shops->pluck('id')->toArray())->update(['status'=> false]);
        Product::whereIn('shop_id',$user->shops->pluck('id')->toArray())->orderBy('created_at','asc')->take($allowed_products)->update(['status'=> true]);
    }

    protected function decreaseProducts(Order $order){
        foreach($order->items as $item){
            $item->product->stock -= $item->quantity;
            $item->product->save();
        }
    }

    protected function increaseProducts(Order $order){
        foreach($order->items as $item){
            $item->product->stock += $item->quantity;
            $item->product->save();
        }
    }

    public function adjustCart(Order $order)
    {
        foreach($order->items as $item){
            $product = $item->product;
            $cart = $this->removeFromCartSession($product);
            $this->removeFromCartDb($product);
        }
    }
}