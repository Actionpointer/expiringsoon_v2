<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Notifications\WelcomeNotification;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\ShopController;
use App\Http\Controllers\Guest\ProductController;
use App\Http\Controllers\Shopper\OrderController;
use App\Http\Controllers\Guest\FrontendController;

Route::get('runonce',function(){
    $products = \App\Models\Product::all();
    // $user->notify(new WelcomeNotification());
    // return (new App\Notifications\WelcomeNotification())
    //                 ->toMail($user);
    foreach($products as $product){
        $product->expire_at = $product->expire_at->addMonths(6);
        $product->save();
    }
    return 'done';
    
});

Route::view('email','emails.completed');
Route::view('help','help.index')->name('help.index');
Route::view('help/shoppers','help.shoppers')->name('help.shoppers');
Route::view('help/vendors','help.vendors')->name('help.vendors');
Route::view('help/api/documentation','help.apidocumentation')->name('help.api_documentation');
Route::view('help/faq','help.faq')->name('help.faq');
Route::view('help/download','help.download')->name('help.download');
Route::view('help/contact','help.contact')->name('help.contact');

Route::view('email','emails.completed');
Auth::routes();
Route::view('start-selling','auth.register_vendor')->name('start-selling');

Route::get('notifications',[UserController::class, 'notifications'])->name('notifications');

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('advert/{advert}', [FrontendController::class, 'redirect'])->name('advert.redirect');

Route::get('products', [ProductController::class, 'index'])->name('product.list');
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('hotdeals',[ProductController::class, 'hotdeals'])->name('hotdeals');
Route::get('categories',[ProductController::class,'categories'])->name('product.categories');
Route::post('getSubcategories', [ProductController::class, 'getSubcategories'])->name('product.getSubcategories');


Route::post('getCities', [HomeController::class, 'cities'])->name('cities');

Route::get('vendors', [ShopController::class, 'index'])->name('vendors');
Route::get('vendors/{shop}', [ShopController::class, 'show'])->name('vendor.show');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('product/add-to-cart',[CartController::class,'addtocart'])->name('product.addtocart');
Route::post('product/remove-from-cart',[CartController::class,'removefromcart'])->name('product.removefromcart');
Route::post('product/add-to-wish',[CartController::class,'addtowish'])->name('product.addtowish');
Route::post('product/remove-from-wish',[CartController::class,'removefromwish'])->name('product.removefromwish');
Route::post('product/sortFilter',[CartController::class,'sortFilter'])->name('product.sortFilter');

Route::get('payment/callback',[App\Http\Controllers\PaymentController::class,'paymentcallback'])->name('payment.callback');

Route::post('payment/webhook',[App\Http\Controllers\PaymentController::class,'webhook'])->name('payment.webhook');

Route::post('payout/callback',[App\Http\Controllers\PayoutController::class,'payoutcallback'])->name('payout.callback');
Route::get('payment/status/{payment}',[App\Http\Controllers\PaymentController::class,'status'])->name('payment.status');
Route::post('account_number_verification',[App\Http\Controllers\PaymentController::class,'accountNumberResolve'])->name('account_number_verification');


Route::get('invoice/{payment}',[App\Http\Controllers\PaymentController::class, 'invoice'])->name('invoice');
Route::get('receipt/{settlement}',[App\Http\Controllers\PaymentController::class, 'receipt'])->name('receipt');

Route::get('home', [HomeController::class, 'home'])->name('home');

//for users
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::post('profile/update',[UserController::class, 'update'])->name('profile.update');
Route::post('edit-password',[UserController::class, 'password'])->name('edit-password');

Route::get('addresses', [UserController::class, 'addresses'])->name('addresses');
Route::post('address',[UserController::class, 'address'])->name('address');


Route::get('wishlist', [OrderController::class, 'wishlist'])->name('wishlist');
Route::post('checkout',[OrderController::class,'checkout'])->name('checkout');
Route::post('checkout/getshipment',[OrderController::class,'shipment'])->name('checkout.shipment');
Route::post('checkout/confirm',[OrderController::class,'confirmcheckout'])->name('confirmcheckout');
Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('order/{order}',[OrderController::class, 'show'])->name('order-details');
Route::get('transactions',[OrderController::class,'transactions'])->name('payments');
Route::post('order/review',[OrderController::class, 'review'])->name('order.review');
Route::post('order/message',[OrderController::class, 'message'])->name('order.message');
Route::get('vendor/{shop}/dashboard', [App\Http\Controllers\Vendor\ShopController::class, 'show'])->name('vendor.shop.show');
include('vendor.php');
include('admin.php');


