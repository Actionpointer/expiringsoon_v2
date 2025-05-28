<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\ResourcesController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Customer\SalesController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Customer\AddressController;



    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    //customer
    Route::view('checkout', 'customer.checkout')->name('checkout');
    Route::view('wishlist', 'customer.wishlist')->name('wishlist');
    Route::view('dashboard', 'customer.dashboard')->name('dashboard');
    Route::view('profile', 'customer.profile')->name('profile');
    Route::view('addresses', 'customer.address')->name('addresses');
    Route::view('followings', 'customer.followings')->name('followings');
    Route::view('notifications', 'customer.notifications')->name('notifications');
    Route::view('orders', 'customer.orders.index')->name('orders');
    Route::view('order/{order}', 'customer.orders.show')->name('order');
    Route::view('order/{order}/disputes', 'customer.orders.disputes')->name('dispute');
    Route::view('order/{order}/messages', 'customer.orders.messages')->name('messages');
    Route::view('order/{order}/timeline', 'customer.orders.timeline')->name('timeline');

    Route::group(['prefix'=> 'otp'],function(){
        Route::get('send',[HomeController::class,'otp_send']);
        Route::post('verify',[HomeController::class,'otp_verify']);
    });

    Route::group(['prefix'=>'payment'],function(){
        Route::post('status',[App\Http\Controllers\PaymentController::class,'paymentcallback']);
    });

    Route::group(['prefix'=>'address'],function(){
        Route::get('/', [AddressController::class, 'index']);
        Route::post('store', [AddressController::class, 'update']);
        Route::post('update', [AddressController::class, 'update']);
        Route::post('destroy', [AddressController::class, 'destroy']); 
    });

    Route::group(['prefix'=> 'followers'],function(){
        Route::get('/', [SalesController::class, 'index']);
        Route::post('follow', [SalesController::class, 'store']);
        Route::post('unfollow', [SalesController::class, 'update']);
    });
    
    // Route::get('wishlist', [SalesController::class, 'wishlist']);
    Route::post('wishlist/add',[CartController::class,'addtowish']);
    Route::post('wishlist/remove',[CartController::class,'removefromwish']);

    // Route::get('cart', [CartController::class, 'cart']);
    Route::post('cart/add',[CartController::class,'addtocart']);
    Route::post('cart/remove',[CartController::class,'removefromcart']);

    Route::post('checkout',[SalesController::class,'checkout_api']);
    Route::post('checkout/confirm',[SalesController::class,'confirmcheckout_api']);

    Route::post('applycoupon',[ResourcesController::class, 'coupon']);

    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('/',[PaymentController::class, 'index']);    
        Route::get('view/{transaction_id}',[PaymentController::class, 'show']);
    });

    // Route::get('mystores', [StoreController::class, 'index']);
    

