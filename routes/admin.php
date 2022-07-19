<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'admin','as'=>'admin.'],function(){
    Route::get('dashboard',[App\Http\Controllers\HomeController::class, 'admin'])->name('dashboard');
    Route::get('users',[App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('user/edit',[App\Http\Controllers\UserController::class, 'edit'])->name('customer.edit');
    Route::post('user/update',[App\Http\Controllers\UserController::class, 'update'])->name('customer.update');
    Route::get('shops', [App\Http\Controllers\ShopController::class, 'adminIndex'])->name('shop.list');
    Route::get('products',[App\Http\Controllers\ProductController::class, 'adminIndex'])->name('products');
    Route::get('categories',[App\Http\Controllers\SettingsController::class, 'categories'])->name('categories');
    Route::get('product/edit/{product}',[App\Http\Controllers\ProductController::class, 'adminEdit'])->name('product.edit');
    Route::get('payouts',[App\Http\Controllers\PaymentController::class, 'adminIndex'])->name('payouts');
    Route::get('orders',[App\Http\Controllers\OrderController::class, 'adminIndex'])->name('orders');
    Route::get('shipping',[App\Http\Controllers\OrderController::class, 'adminShipping'])->name('shipping');
    Route::get('settings',[App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::get('invoice',[App\Http\Controllers\PaymentController::class,'invoice'])->name('invoice');
});