<?php
 
namespace App\Listeners;

use App\Models\Shop;
use App\Models\Product;
 
class ResetShopsAndProductsStatus
{
    /**
     * Handle user login events.
     */
    public function resetShops($event) {
        $user = $event->user;
        $allowed_shops = $user->max_shops;
        Shop::where('user_id',$user->id)->update(['status'=> false]);
        Shop::where('user_id',$user->id)->orderBy('created_at','asc')->take($allowed_shops)->update(['status'=> true]);
    }
 
    /**
     * Handle user logout events.
     */
    public function resetProducts($event) {
        $user = $event->user;
        $allowed_products = $user->max_products;
        Product::whereIn('shop_id',$user->shops->pluck('id')->toArray())->update(['status'=> false]);
        Product::whereIn('shop_id',$user->shops->pluck('id')->toArray())->orderBy('created_at','asc')->take($allowed_products)->update(['status'=> true]);
    }
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\DeleteShop',
            [ResetShopsAndProductsStatus::class,'resetShops', ResetShopsAndProductsStatus::class,'resetProducts']
        );
        $events->listen(
            'App\Events\DeleteProduct',
            [ResetShopsAndProductsStatus::class,'resetShops', ResetShopsAndProductsStatus::class,'resetProducts']
        );
 
        $events->listen(
            'App\Events\UserSubscribed',
            [ResetShopsAndProductsStatus::class,'resetShops', ResetShopsAndProductsStatus::class,'resetProducts']
        );

        $events->listen(
            'App\Events\SubscriptionExpired',
            [ResetShopsAndProductsStatus::class,'resetShops', ResetShopsAndProductsStatus::class,'resetProducts']
        );
    }
 
}