<?php
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('broadcast', function () {
    
    $user = \App\Models\User::find(31);
    // // $shop = \App\Models\Store::find(2);
    // // dd($shop->followers);
    // return (new App\Notifications\FollowersFeaturedProductNotification($shop))
    //                 ->toMail($shop->followers);
    $user->notify(new \App\Notifications\WelcomeNotification());
    return 'ok';
});

Route::group(['prefix'=> 'test'],function(){
    Route::get('orders',function(){
        $order = \App\Models\Order::find(124);
        dd($order->currency_values);
    });

    Route::get('products',function(){
        $products = Product::all();
        foreach($products as $product){
            $xtg = [];
            foreach($product->tags as $tag){
                $xtg[] = trim($tag);
            }
            $product->tags = $xtg;
            $product->save();
        }
        return 'all done';
    });

    Route::get('customers',function(){
        $users = User::where('role_id',8)->orderBy('id','asc')->get();
        foreach($users as $key => $user){
            $user->email = 'customer'.($key+1).'@gmail.com';
            $user->save();
        }
        return 'all done';
    });
});