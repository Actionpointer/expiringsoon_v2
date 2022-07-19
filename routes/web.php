<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
Route::get('product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::post('getSubcategories', [App\Http\Controllers\ProductController::class, 'getSubcategories'])->name('product.getSubcategories');

Route::get('vendors', [App\Http\Controllers\ShopController::class, 'index'])->name('vendors');
Route::get('vendors/{shop}', [App\Http\Controllers\ShopController::class, 'show'])->name('vendor.show');




Route::get('account', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
//for users
Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('profile/update',[App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
Route::post('edit-address',[App\Http\Controllers\SettingsController::class, 'address'])->name('edit-address');
Route::post('edit-password',[App\Http\Controllers\SettingsController::class, 'password'])->name('edit-password');
Route::post('topup',[App\Http\Controllers\UserController::class, 'topup'])->name('topup');
Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');
Route::get('order/{order}',[App\Http\Controllers\OrderController::class, 'show'])->name('order-details');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::get('wishlist', [App\Http\Controllers\CartController::class, 'wishlist'])->name('wishlist');
Route::post('checkout',[App\Http\Controllers\CartController::class,'checkout'])->name('checkout');

//for vendors
Route::get('vendor/dashboard', [App\Http\Controllers\HomeController::class, 'vendor'])->name('vendor.dashboard');

Route::post('edit-photo',[App\Http\Controllers\SettingsController::class, 'photo'])->name('edit-photo');
Route::post('bank-info',[App\Http\Controllers\SettingsController::class, 'bank_info'])->name('bank-info');
Route::post('upload-id',[App\Http\Controllers\SettingsController::class, 'upload_id'])->name('upload_id');

// Route::get('vendor/staffprofile', [App\Http\Controllers\UserController::class, 'staffprofile'])->name('staff.profile');

Route::get('invoice', [App\Http\Controllers\OrderController::class, 'invoice'])->name('invoice');

Route::post('product/add-to-cart',[App\Http\Controllers\CartController::class,'addtocart'])->name('product.addtocart');
Route::post('product/remove-from-cart',[App\Http\Controllers\CartController::class,'removefromcart'])->name('product.removefromcart');
Route::post('product/add-to-wish',[App\Http\Controllers\CartController::class,'addtowish'])->name('product.addtowish');
Route::post('product/remove-from-wish',[App\Http\Controllers\CartController::class,'removefromwish'])->name('product.removefromwish');
Route::post('product/sortFilter',[App\Http\Controllers\CartController::class,'sortFilter'])->name('product.sortFilter');

Route::post('pay',[App\Http\Controllers\PaymentController::class,'pay'])->name('pay');
Route::get('payment/verification',[App\Http\Controllers\PaymentController::class,'verification'])->name('payment.verification');
Route::get('payment/status/{payment}',[App\Http\Controllers\PaymentController::class,'status'])->name('payment.status');
Route::post('account_number_verification',[App\Http\Controllers\PaymentController::class,'accountNumberResolve'])->name('account_number_verification');


include('shop.php');
include('admin.php');



