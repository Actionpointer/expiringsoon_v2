<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('email','emails.completed');

Auth::routes();
Route::view('start-selling','auth.register')->name('start-selling');
Route::get('notifications',[App\Http\Controllers\UserController::class, 'notifications'])->name('notifications');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
Route::get('product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::get('advert/{advert}', [App\Http\Controllers\AdvertController::class, 'redirect'])->name('advert.redirect');
Route::post('getSubcategories', [App\Http\Controllers\ProductController::class, 'getSubcategories'])->name('product.getSubcategories');
Route::post('getCities', [App\Http\Controllers\HomeController::class, 'cities'])->name('cities');

Route::get('vendors', [App\Http\Controllers\ShopController::class, 'index'])->name('vendors');
Route::get('vendors/{shop}', [App\Http\Controllers\ShopController::class, 'show'])->name('vendor.show');
Route::get('hotdeals',[App\Http\Controllers\HomeController::class, 'hotdeals'])->name('hotdeals');

Route::get('account', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
//for users
Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('profile/update',[App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
Route::get('support', [App\Http\Controllers\MessageController::class, 'index'])->name('messages');
Route::post('support',[App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

Route::post('address',[App\Http\Controllers\UserController::class, 'address'])->name('address');
Route::post('edit-password',[App\Http\Controllers\UserController::class, 'password'])->name('edit-password');
Route::post('edit-pin',[App\Http\Controllers\UserController::class, 'pin'])->name('edit-pin');
Route::post('topup',[App\Http\Controllers\PaymentController::class, 'topup'])->name('topup');
Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');
Route::get('order/{order}',[App\Http\Controllers\OrderController::class, 'show'])->name('order-details');

Route::post('order/message',[App\Http\Controllers\OrderController::class, 'message'])->name('order.message');

Route::get('cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::get('wishlist', [App\Http\Controllers\CartController::class, 'wishlist'])->name('wishlist');
Route::post('checkout',[App\Http\Controllers\CartController::class,'checkout'])->name('checkout');
Route::post('checkout/getshipment',[App\Http\Controllers\CartController::class,'shipment'])->name('checkout.shipment');
Route::post('checkout/confirm',[App\Http\Controllers\CartController::class,'confirmcheckout'])->name('confirmcheckout');

Route::post('product/add-to-cart',[App\Http\Controllers\CartController::class,'addtocart'])->name('product.addtocart');
Route::post('product/remove-from-cart',[App\Http\Controllers\CartController::class,'removefromcart'])->name('product.removefromcart');
Route::post('product/add-to-wish',[App\Http\Controllers\CartController::class,'addtowish'])->name('product.addtowish');
Route::post('product/remove-from-wish',[App\Http\Controllers\CartController::class,'removefromwish'])->name('product.removefromwish');
Route::post('product/sortFilter',[App\Http\Controllers\CartController::class,'sortFilter'])->name('product.sortFilter');

Route::get('payment/callback',[App\Http\Controllers\PaymentController::class,'paymentcallback'])->name('payment.callback');
Route::post('payout/callback',[App\Http\Controllers\PayoutController::class,'payoutcallback'])->name('payout.callback');
Route::get('payment/status/{payment}',[App\Http\Controllers\PaymentController::class,'status'])->name('payment.status');
Route::post('account_number_verification',[App\Http\Controllers\PaymentController::class,'accountNumberResolve'])->name('account_number_verification');

Route::get('transactions',[App\Http\Controllers\PaymentController::class,'index'])->name('payments');

Route::get('invoice/{payment}',[App\Http\Controllers\PaymentController::class, 'invoice'])->name('invoice');
Route::get('receipt/{settlement}',[App\Http\Controllers\PaymentController::class, 'receipt'])->name('receipt');
Route::get('adset/description/',[App\Http\Controllers\AdvertController::class,'description'])->name('adsets');
Route::get('runjob',[App\Http\Controllers\ShipmentController::class,'index'])->name('runjob');
include('vendor.php');
include('shop.php');
include('admin.php');


