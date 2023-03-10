<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::group(['prefix'=> 'admin','as'=>'admin.','middleware'=> 'role:superadmin,admin,customercare,security,auditor'],function(){
    Route::get('dashboard',[UserController::class, 'dashboard'])->name('dashboard');
    
    Route::group(['prefix'=> 'settings','as'=>'settings.'],function(){
        Route::get('/',[SettingsController::class, 'index'])->name('global');
        Route::post('store',[SettingsController::class, 'store'])->name('store');

        Route::get('country/{country}',[SettingsController::class, 'country'])->name('country');
        Route::post('country/basic',[SettingsController::class, 'country_basic'])->name('country.basic');
        Route::post('country/states',[SettingsController::class, 'country_states'])->name('country.states');
        Route::post('country/cities',[SettingsController::class, 'country_cities'])->name('country.cities');

        Route::get('plan/{plan}',[SettingsController::class, 'plan'])->name('plan');
        Route::post('plans',[SettingsController::class, 'plans'])->name('plans');
        Route::post('plan/pricing',[SettingsController::class, 'plan_pricing'])->name('plan.pricing');

        Route::get('advert-plans/{adplan}',[SettingsController::class, 'adplan'])->name('adplan');
        Route::post('adplans',[SettingsController::class, 'adplans'])->name('adplans');
        Route::post('ad/pricing',[SettingsController::class, 'ad_pricing'])->name('ad.pricing');

        Route::get('logistics',[SettingsController::class, 'logistics'])->name('logistics');
        
    });
    
    Route::group(['prefix'=> 'shipment','as'=>'shipments.'],function(){
        Route::get('index',[ShipmentController::class, 'index'])->name('index');
        Route::post('store',[ShipmentController::class, 'store'])->name('store');
        Route::post('update',[ShipmentController::class, 'update'])->name('update');
        Route::post('destroy',[ShipmentController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix'=> 'staff','as'=>'staff.'],function(){
        Route::post('store',[UserController::class, 'store'])->name('store');
        Route::post('update',[UserController::class, 'update'])->name('update');
        Route::post('delete',[UserController::class, 'destroy'])->name('delete');
    });
    
    

    
    Route::get('coupons',[CouponController::class, 'list'])->name('coupons');
    Route::post('coupons/manage',[CouponController::class, 'manage'])->name('coupon.manage');
    Route::get('subscriptions',[SubscriptionController::class, 'admin_index'])->name('subscriptions');
    Route::post('subscriptions',[SubscriptionController::class, 'update'])->name('subscriptions');
    
    Route::get('categories',[ProductController::class, 'categories'])->name('categories');
    Route::post('category/store',[ProductController::class, 'category_store'])->name('category.store');
    Route::post('category/update',[ProductController::class, 'category_update'])->name('category.update');
    Route::post('category/delete',[ProductController::class, 'category_destroy'])->name('category.destroy');
    
    Route::get('products',[ProductController::class, 'index'])->name('products');
    Route::post('products',[ProductController::class, 'manage'])->name('products.manage');

    Route::get('users',[UserController::class, 'index'])->name('users');
    Route::get('users/show/{user}',[UserController::class, 'show'])->name('user.show');
    Route::post('users',[UserController::class, 'manage'])->name('user.manage');
    
    Route::get('shops', [ShopController::class, 'index'])->name('shops');
    Route::get('shop/manage/{shop}', [ShopController::class, 'show'])->name('shop.show');
    Route::post('shop/management', [ShopController::class, 'manage'])->name('shop.manage');
    Route::post('shop/manage', [ShopController::class, 'kyc'])->name('kyc.manage');
    

    Route::get('orders',[OrderController::class, 'index'])->name('orders');
    Route::get('order/{order}',[OrderController::class, 'show'])->name('order.show');
    Route::post('order/update',[OrderController::class, 'update'])->name('order.update');
    Route::post('order/resolution',[OrderController::class, 'resolution'])->name('order.resolution');
    Route::post('order/message/',[OrderController::class, 'message'])->name('order.message');

    Route::get('payments',[PaymentController::class, 'index'])->name('payments');
    Route::get('payouts',[PaymentController::class, 'payouts'])->name('payouts');
    Route::post('payouts/manage',[PaymentController::class, 'update'])->name('payouts.manage');


    Route::get('adverts',[AdvertController::class, 'index'])->name('adverts');
    Route::post('adverts/manage',[AdvertController::class, 'manage'])->name('adverts.manage');

    Route::get('security',[SecurityController::class, 'index'])->name('security');
});