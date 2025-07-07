<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Customer\ProfilePage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Livewire\Customer\DashboardPage;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Customer\SalesController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Guest\ResourcesController;
use App\Http\Controllers\Customer\AddressController;
use App\Livewire\Customer\Address\AddressPage;
use App\Livewire\Customer\CheckoutPage;
use App\Livewire\Customer\Following\FollowPage;
use App\Livewire\Customer\Notifications\NotificationPage;
use App\Livewire\Customer\Orders\AllOrders;
use App\Livewire\Customer\Orders\SingleOrder;
use App\Livewire\Customer\WishlistPage;

    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    //customer
    Route::get('checkout', CheckoutPage::class)->name('checkout');
    Route::get('wishlist', WishlistPage::class)->name('wishlist');
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
    Route::get('profile', ProfilePage::class)->name('profile');
    Route::get('addresses', AddressPage::class)->name('addresses');
    Route::get('followings', FollowPage::class)->name('followings');
    Route::get('notifications', NotificationPage::class)->name('notifications');
    Route::get('orders', AllOrders::class)->name('orders');
    Route::get('order/{order}', SingleOrder::class)->name('order');
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