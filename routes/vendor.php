<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'vendor','as'=>'vendor.','middleware'=> 'role:vendor'],function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'vendor'])->name('dashboard');
    Route::get('shops', [App\Http\Controllers\ShopController::class, 'list'])->name('shops');
    Route::get('shop/create', [App\Http\Controllers\ShopController::class, 'create'])->name('shop.create');
    Route::post('shop/store', [App\Http\Controllers\ShopController::class, 'store'])->name('shop.store');    

    Route::get('plans',[App\Http\Controllers\SubscriptionController::class, 'plans'])->name('plans');
    Route::post('subscription/plans', [App\Http\Controllers\SubscriptionController::class, 'plan_subscription'])->name('subscription.plan');
    Route::post('subscription/cancel-renew', [App\Http\Controllers\SubscriptionController::class, 'subscription_cancel_renew'])->name('subscription.cancel_renew');   
    Route::post('applycoupon',[App\Http\Controllers\CouponController::class, 'apply'])->name('applycoupon');

    Route::post('subscription/features', [App\Http\Controllers\SubscriptionController::class, 'feature_subscription'])->name('subscription.feature');   
    
    Route::post('feature/cancel-renew', [App\Http\Controllers\SubscriptionController::class, 'feature_cancel_renew'])->name('feature.cancel_renew');   
    
    Route::get('transactions',[App\Http\Controllers\PaymentController::class,'index'])->name('payments');

    //adplans bought, and buy adplans
    Route::get('adsets', [App\Http\Controllers\AdvertController::class, 'adsets'])->name('adsets');   
    
    //list adds, create ads (both shop and products)
    Route::get('adverts/{feature}',[App\Http\Controllers\AdvertController::class,'ads'])->name('adverts');

    //create featured ads
    Route::post('feature/products',[App\Http\Controllers\AdvertController::class,'feature_products'])->name('feature.products');
    Route::post('feature/products/subscription',[App\Http\Controllers\AdvertController::class,'feature_products_subscription'])->name('feature.products.subscription');

    Route::post('adverts/product/filter',[App\Http\Controllers\AdvertController::class,'filter_products'])->name('advert.filter_product');
    Route::post('adverts/store/product',[App\Http\Controllers\AdvertController::class,'store_product_advert'])->name('advert.store.products');
    Route::post('adverts/store/shop',[App\Http\Controllers\AdvertController::class,'store_shop_advert'])->name('advert.store.shops');
    
    Route::post('adverts/manage',[App\Http\Controllers\AdvertController::class,'remove'])->name('advert.remove');

    
});