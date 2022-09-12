<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'vendor','as'=>'vendor.','middleware'=> 'role:vendor'],function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'vendor'])->name('dashboard');
    Route::get('shops', [App\Http\Controllers\ShopController::class, 'list'])->name('shops');
    Route::get('shop/create', [App\Http\Controllers\ShopController::class, 'create'])->name('shop.create');
    Route::post('shop/store', [App\Http\Controllers\ShopController::class, 'store'])->name('shop.store');    
    Route::get('subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions');   
    Route::post('subscription-plans/', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.store');   
    Route::post('subscription/cancel-renew', [App\Http\Controllers\SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
    Route::get('transactions',[App\Http\Controllers\PaymentController::class,'index'])->name('payments');
    Route::get('features',[App\Http\Controllers\AdvertController::class,'index'])->name('features');
    Route::get('features/description/{plan}',[App\Http\Controllers\AdvertController::class,'description'])->name('feature.description');
    Route::get('adverts/{plan}',[App\Http\Controllers\AdvertController::class,'create'])->name('adverts');
    Route::post('adverts/product/filter',[App\Http\Controllers\AdvertController::class,'filter_products'])->name('advert.filter_product');
    Route::post('adverts/store/product',[App\Http\Controllers\AdvertController::class,'store_product_advert'])->name('advert.store.products');
    Route::post('adverts/store/shop',[App\Http\Controllers\AdvertController::class,'store_shop_advert'])->name('advert.store.shops');
    Route::post('adverts/manage',[App\Http\Controllers\AdvertController::class,'manage'])->name('adverts.manage');
    Route::get('analytics',[App\Http\Controllers\HomeController::class, 'analytics'])->name('analytics');
});