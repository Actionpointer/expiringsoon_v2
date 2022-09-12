<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Http\Traits\CartTrait;
use App\Models\Subscription;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin implements ShouldQueue
{
    use CartTrait;
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
        $user = Auth::user();
        //first give session cart to database
        $cart = request()->session()->get('cart');
        if($cart){
            foreach($cart as $key => $value){
                $this->addToCartDb($value['product'],$value['quantity'],true);
            }
        }
        //then give cart database to session
        $dbcarts = Cart::where('user_id',$user->id)->whereNull('order_id')->get();
        if($dbcarts->isNotEmpty()){
            foreach($dbcarts as $dbcart){
               $cart =  $this->addToCartSession($dbcart->product,$dbcart->quantity,true);
            }
        }
    }
}
