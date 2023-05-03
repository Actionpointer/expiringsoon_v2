<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\Subscription;
use App\Http\Traits\CartTrait;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;


class LogSuccessfulLogin
{
    use CartTrait,OptimizationTrait;
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = auth()->user();
        if($user->role->name == 'vendor'){
            if($user->subscription && $user->subscription->end_at && $user->subscription->expired()){
                $user->subscription->delete();
            }
            $this->resetProducts($user);
            $this->resetShops($user);
        }
        if($user->role->name == 'staff'){
            if($user->shop->user->subscription->end_at && $user->shop->user->subscription->expired()){
                $user->shop->user->subscription->delete();
            }
            $this->resetProducts($user->shop->user);
            $this->resetShops($user->shop->user);
        }
        if($user->role->name == 'shopper'){
            $cart = session('cart');
            if($cart){
                foreach($cart as $key => $value){
                    $this->addToCartDb($value['product'],$value['quantity'],true);
                }
            }
            //then give cart database to session
            $dbcarts = Cart::where('user_id',$user->id)->get();
            if($dbcarts->isNotEmpty()){
                foreach($dbcarts as $dbcart){
                $cart =  $this->addToCartSession($dbcart->product,$dbcart->quantity,true);
                }
            }
        }
        
        
        //first give session cart to database
        
        
    }
}
