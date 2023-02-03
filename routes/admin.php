<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SubscriptionController;

Route::group(['prefix'=> 'admin','as'=>'admin.','middleware'=> 'role:admin,customercare,security,auditor'],function(){
    Route::get('dashboard',[HomeController::class, 'admin'])->name('dashboard');
    Route::get('settings',[SettingsController::class, 'index'])->name('settings');
    Route::get('settings/country/{country}',[SettingsController::class, 'country'])->name('country');
    Route::post('settings',[SettingsController::class, 'settings'])->name('settings');

    Route::group(['prefix'=> 'shipment','as'=>'shipments.'],function(){
        Route::get('index',[ShipmentController::class, 'index'])->name('index');
        Route::post('store',[ShipmentController::class, 'store'])->name('store');
        Route::post('update',[ShipmentController::class, 'update'])->name('update');
        Route::post('destroy',[ShipmentController::class, 'destroy'])->name('delete');
        
    });
    

    Route::post('staff',[SettingsController::class, 'admins'])->name('staff');
    Route::post('plans',[SettingsController::class, 'plans'])->name('plans');
    Route::post('plans/pricing',[SettingsController::class, 'plans'])->name('plans.pricing');
    Route::post('adplans',[SettingsController::class, 'adplans'])->name('adplans');
    Route::get('coupons',[CouponController::class, 'list'])->name('coupons');
    Route::post('coupons/manage',[CouponController::class, 'manage'])->name('coupon.manage');
    Route::get('subscriptions',[SubscriptionController::class, 'admin_index'])->name('subscriptions');
    Route::post('subscriptions',[SubscriptionController::class, 'update'])->name('subscriptions');
    
    Route::get('categories',[SettingsController::class, 'categories'])->name('categories');
    Route::post('categories',[SettingsController::class, 'categories_management'])->name('categories.management');
    

    Route::get('shops', [ShopController::class, 'index'])->name('shops');
    Route::get('shop/manage/{shop}', [ShopController::class, 'show'])->name('shop.show');
    Route::post('shop/management', [ShopController::class, 'manage'])->name('shop.manage');
    Route::post('shop/manage', [ShopController::class, 'kyc'])->name('kyc.manage');
    
    Route::get('products',[ProductController::class, 'index'])->name('products');
    Route::post('products',[ProductController::class, 'manage'])->name('products.manage');

    Route::get('orders',[OrderController::class, 'index'])->name('orders');
    Route::post('orders',[OrderController::class, 'update'])->name('order.manage');
    
    Route::get('payments',[PaymentController::class, 'index'])->name('payments');
    Route::get('payouts',[PaymentController::class, 'payouts'])->name('payouts');
    Route::post('payouts/manage',[PaymentController::class, 'update'])->name('payouts.manage');


    Route::get('adverts',[AdvertController::class, 'index'])->name('adverts');
    Route::post('adverts/manage',[AdvertController::class, 'manage'])->name('adverts.manage');


    
    Route::get('users',[UserController::class, 'index'])->name('users');
    Route::get('users/show/{user}',[UserController::class, 'show'])->name('user.show');
    Route::post('users',[UserController::class, 'manage'])->name('user.manage');

    Route::get('messages',[MessageController::class, 'index'])->name('messages');
    Route::get('message/{user}',[MessageController::class, 'show'])->name('message');
    Route::post('message/{user}',[MessageController::class, 'store'])->name('message');
    
    Route::get('security',[SecurityController::class, 'index'])->name('security');
});