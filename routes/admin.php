<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PlacesController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShipmentController;

Route::group(['prefix'=> 'admin','as'=>'admin.','middleware'=> 'role:superadmin,admin,manager,customercare,auditor'],function(){
    Route::get('dashboard',[UserController::class, 'dashboard'])->name('dashboard');
    
    Route::group(['middleware'=> 'role:superadmin'],function(){
        Route::group(['prefix'=> 'settings','as'=>'settings.'],function(){
            Route::get('/',[SettingsController::class, 'index'])->name('global');
            Route::post('store',[SettingsController::class, 'store'])->name('store');

            Route::get('country/{country}',[PlacesController::class, 'country'])->name('country');
            Route::post('country/basic',[PlacesController::class, 'country_basic'])->name('country.basic');
            Route::post('country/states',[PlacesController::class, 'country_states'])->name('country.states');
            Route::post('country/cities',[PlacesController::class, 'country_cities'])->name('country.cities');
            Route::post('state/manage',[PlacesController::class, 'state_manage'])->name('state.manage');
            Route::post('city/manage',[PlacesController::class, 'city_manage'])->name('city.manage');

            Route::get('plan/{plan}',[SettingsController::class, 'plan'])->name('plan');
            Route::post('plans',[SettingsController::class, 'plans'])->name('plans');
            Route::post('plan/pricing',[SettingsController::class, 'plan_pricing'])->name('plan.pricing');

            Route::get('advert-plans/{adplan}',[SettingsController::class, 'adplan'])->name('adplan');
            Route::post('adplans',[SettingsController::class, 'adplans'])->name('adplans');
            Route::post('ad/pricing',[SettingsController::class, 'ad_pricing'])->name('ad.pricing');            
        });
        Route::get('security',[SecurityController::class, 'index'])->name('security');
        Route::post('security/ipaddress/block',[SecurityController::class, 'ip_block'])->name('security.ip_block');
        Route::post('security/ipaddress/release',[SecurityController::class, 'ip_release'])->name('security.ip_release');

        Route::get('categories',[ProductController::class, 'categories'])->name('categories');
        Route::post('category/store',[ProductController::class, 'category_store'])->name('category.store');
        Route::post('category/update',[ProductController::class, 'category_update'])->name('category.update');
        Route::post('category/delete',[ProductController::class, 'category_destroy'])->name('category.destroy');

    });

    Route::group(['middleware'=> 'role:superadmin,admin,manager'],function(){
        Route::post('payouts/manage',[PaymentController::class, 'update'])->name('payouts.manage');

        Route::group(['prefix'=> 'staff','as'=>'staff.'],function(){
            Route::get('/',[UserController::class, 'staff'])->name('list');
            Route::post('store',[UserController::class, 'store'])->name('store');
            Route::post('update',[UserController::class, 'update'])->name('update');
            Route::post('delete',[UserController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix'=> 'shipments','as'=>'shipments.'],function(){
            Route::get('rates',[ShipmentController::class, 'rates'])->name('rates');
            Route::post('store',[ShipmentController::class, 'store'])->name('store');
            Route::post('update',[ShipmentController::class, 'update'])->name('update');
            Route::post('destroy',[ShipmentController::class, 'destroy'])->name('delete');
        });
    });

    Route::group(['middleware'=> 'role:superadmin,admin,manager,auditor'],function(){
        Route::get('payments',[PaymentController::class, 'index'])->name('payments');
        Route::post('payments/export', [PaymentController::class, 'exportPayments'])->name('payments.export');
        Route::get('settlements',[PaymentController::class, 'settlements'])->name('settlements');
        Route::post('settlements/export', [PaymentController::class, 'exportSettlements'])->name('settlements.export');
        Route::get('payouts',[PaymentController::class, 'payouts'])->name('payouts');
        Route::get('payouts/export', [PaymentController::class, 'exportPayouts'])->name('payouts.export');
    });

    Route::group(['middleware'=> 'role:superadmin,admin,manager,customercare'],function(){
        
        Route::get('coupons',[CouponController::class, 'list'])->name('coupons');
        Route::post('coupons/store',[CouponController::class, 'store'])->name('coupon.store');
        Route::post('coupons/update',[CouponController::class, 'update'])->name('coupon.update');
        Route::post('coupons/delete',[CouponController::class, 'destroy'])->name('coupon.delete');

        Route::get('vendors',[UserController::class, 'vendors'])->name('vendors');
        Route::get('customers',[UserController::class, 'customers'])->name('customers');
        Route::get('user/show/{user}',[UserController::class, 'show'])->name('user.show');
        Route::post('user',[UserController::class, 'manage'])->name('user.manage');

        Route::get('adsets',[AdvertController::class, 'adsets'])->name('adsets');
        Route::get('adverts',[AdvertController::class, 'index'])->name('adverts');
        Route::post('adverts/manage',[AdvertController::class, 'manage'])->name('adverts.manage');

        Route::get('shops', [ShopController::class, 'index'])->name('shops');
        Route::get('shop/manage/{shop}', [ShopController::class, 'show'])->name('shop.show');
        Route::post('shop/management', [ShopController::class, 'manage'])->name('shop.manage');
        Route::post('shop/manage', [ShopController::class, 'kyc'])->name('kyc.manage');

        Route::get('products',[ProductController::class, 'index'])->name('products');
        Route::post('products',[ProductController::class, 'manage'])->name('products.manage');

        Route::get('orders',[OrderController::class, 'index'])->name('orders');
        Route::get('order/{order}',[OrderController::class, 'show'])->name('order.show');
        Route::post('order/update',[OrderController::class, 'update'])->name('order.update');
        Route::post('order/resolution',[OrderController::class, 'resolution'])->name('order.resolution');
        Route::post('order/message/',[OrderController::class, 'message'])->name('order.message');
        
        Route::group(['prefix'=> 'shipments','as'=>'shipments.'],function(){
            Route::get('/',[ShipmentController::class, 'index'])->name('index');
            Route::post('process',[ShipmentController::class, 'process'])->name('process');
            
        });


    });
    
});