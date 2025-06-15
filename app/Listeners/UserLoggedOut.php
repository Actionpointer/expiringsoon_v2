<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Http\Traits\CartTrait;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoggedOut
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //give session cart to database
        // $cart = request()->session()->get('cart');
        // if($cart){
        //     foreach($cart as $key => $value){
        //         $this->addToCartDb($value['product'],$value['quantity'],true);
        //     }
        // }
    }
}
