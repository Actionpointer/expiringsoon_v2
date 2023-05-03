<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\ShopController;
use App\Http\Controllers\Guest\ProductController;
use App\Http\Controllers\Shopper\OrderController;
use App\Http\Controllers\Guest\FrontendController;
use App\Http\Controllers\Shopper\AddressController;

Route::get('/eg', function () {
    // $countries = \App\Models\Country::where('payout_gateway','paypal')->get();
    // $users = \App\Models\User::where('role_id',6)->whereIn('country_id',$countries->pluck('id')->toArray())->get();
    // foreach($users as $user){
    //     $user->payout_account = $user->email;
    //     $user->save();
    // }
    // return "Event broadcaasted!";
    $adset = \App\Models\Subscription::where('end_at','<',now())->delete();
    return (new App\Notifications\SubscriptionStatusNotification($adset))
                    ->toMail($adset->user);
});

Route::get('/broadcast', function () {
    $payout = \App\Models\Payout::find(2);
    return (new App\Notifications\PayoutStatusNotification($payout))
                    ->toMail($payout->user);

});




Route::view('email','emails.completed');
Route::view('help','help.index')->name('help.index');
Route::view('help/shoppers','help.shoppers')->name('help.shoppers');
Route::view('help/vendors','help.vendors')->name('help.vendors');
Route::view('help/api/documentation','help.apidocumentation')->name('help.api_documentation');
Route::view('help/faq','help.faq')->name('help.faq');
Route::view('help/download','help.download')->name('help.download');
Route::view('help/contact','frontend.contact')->name('help.contact');
Route::get('shipments',[FrontendController::class,'shipment'])->name('shipment');
Route::post('shipment/search',[FrontendController::class,'shipment_search'])->name('shipment.search');
Route::post('shipment/updated',[FrontendController::class,'shipment_update'])->name('shipment.update');

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('advert/{advert}', [FrontendController::class, 'redirect'])->name('advert.redirect');

Route::get('products', [ProductController::class, 'index'])->name('product.list');
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('hotdeals',[ProductController::class, 'hotdeals'])->name('hotdeals');
Route::get('categories',[ProductController::class,'categories'])->name('product.categories');
Route::post('getSubcategories', [ProductController::class, 'getSubcategories'])->name('product.getSubcategories');


Route::get('getStates/{country_id?}', [ResourcesController::class, 'states'])->name('states');
Route::get('getCities/{state_id}', [ResourcesController::class, 'cities'])->name('cities');

Route::get('vendors', [ShopController::class, 'index'])->name('vendors');
Route::get('vendors/{shop}', [ShopController::class, 'show'])->name('vendor.show');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('product/add-to-cart',[CartController::class,'addtocart'])->name('product.addtocart');
Route::post('product/remove-from-cart',[CartController::class,'removefromcart'])->name('product.removefromcart');
Route::post('product/add-to-wish',[CartController::class,'addtowish'])->name('product.addtowish');
Route::post('product/remove-from-wish',[CartController::class,'removefromwish'])->name('product.removefromwish');
Route::post('product/sortFilter',[CartController::class,'sortFilter'])->name('product.sortFilter');

Route::get('payment/callback',[App\Http\Controllers\PaymentController::class,'paymentcallback'])->name('payment.callback');
// Route::post('payment/status',[App\Http\Controllers\PaymentController::class,'status'])->name('payment.status');
Route::post('payout/callback',[App\Http\Controllers\PayoutController::class,'payoutcallback'])->name('payout.callback');


Route::get('invoice/{payment}',[App\Http\Controllers\PaymentController::class, 'invoice'])->name('invoice');
Route::get('receipt/{payout}',[App\Http\Controllers\PaymentController::class, 'receipt'])->name('receipt');
Route::view('start-selling','auth.register_vendor')->name('start-selling');

Auth::routes(['verify' => true]);
Route::group(['middleware'=> 'verified'],function(){
    Route::view('change_password','auth.forcepassword')->name('forcepasswordchange');
    Route::post('changed_password',[LoginController::class, 'forcepassword'] )->name('forcepassword');
    
    Route::get('notifications',[UserController::class, 'notifications'])->name('notifications');
    Route::get('notifications/read',[UserController::class, 'readNotifications'])->name('notifications.read');
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //for users
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/update',[UserController::class, 'update'])->name('profile.update');
    Route::post('edit-password',[UserController::class, 'password'])->name('edit-password');
    Route::get('generate/otp',[UserController::class, 'generate_otp'])->name('generate_otp');
    Route::post('edit-pin',[UserController::class, 'pin'])->name('edit-pin');
    Route::get('addresses', [AddressController::class, 'index'])->name('addresses');
    Route::post('address/store',[AddressController::class, 'store'])->name('address.store');
    Route::post('address/update',[AddressController::class, 'update'])->name('address.update');
    Route::post('address/delete',[AddressController::class, 'destroy'])->name('address.delete');
    Route::get('wishlist', [OrderController::class, 'wishlist'])->name('wishlist');
    Route::get('checkout/{shop?}',[OrderController::class,'checkout'])->name('checkout');
    Route::post('checkout/getshipment',[OrderController::class,'shipment'])->name('checkout.shipment');
    Route::post('checkout/confirm',[OrderController::class,'confirmcheckout'])->name('confirmcheckout');

    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('order/{order}',[OrderController::class, 'show'])->name('order.show');
    Route::post('order/update',[OrderController::class, 'update'])->name('order.update');
    // Route::get('transactions',[OrderController::class,'transactions'])->name('payments');
    Route::post('order/review',[OrderController::class, 'review'])->name('order.review');

    // Route::get('order/{order}/messages',[OrderController::class, 'messages'])->name('order.messages');
    Route::post('order/message',[OrderController::class, 'message'])->name('order.message');

    include('vendor.php');
    include('admin.php');
});





