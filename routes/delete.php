<?php
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::view('terms','frontend.legal.term_of_use')->name('terms');
Route::view('privacy_policy','frontend.legal.privacy_policy')->name('privacy');
Route::view('email','emails.completed');
Route::view('help','help.index')->name('help.index');
Route::view('help/shoppers','help.shoppers')->name('help.shoppers');
Route::view('help/vendors','help.vendors')->name('help.vendors');
Route::view('help/api/documentation','help.apidocumentation')->name('help.api_documentation');
Route::view('help/faq','help.faq')->name('help.faq');
Route::view('help/download','help.download')->name('help.download');
Route::view('contact','frontend.contact')->name('contact');
Route::get('shipments',[FrontendController::class,'shipment'])->name('shipment');
Route::post('shipment/search',[FrontendController::class,'shipment_search'])->name('shipment.search');
Route::post('shipment/updated',[FrontendController::class,'shipment_update'])->name('shipment.update');

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