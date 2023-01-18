<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\AdvertController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\SubscriptionController;
use App\Http\Controllers\Vendor\UserController;

Route::group(['prefix'=> 'vendor','as'=>'vendor.','middleware'=> 'role:vendor'],function () {
    Route::get('get-started',[UserController::class, 'orientation'])->name('orientation');
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('verification',[UserController::class,'verification'])->name('verification');

    Route::get('shops', [ShopController::class, 'index'])->name('shops');
    Route::get('shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('shop/store', [ShopController::class, 'store'])->name('shop.store');    
    Route::post('shop/update',[ShopController::class, 'update'])->name('shop.update');
    
    Route::get('plans',[SubscriptionController::class, 'plans'])->name('plans');
    Route::post('subscription/plans', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
    Route::post('subscription/cancel-renewal', [SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
    
     //adplans bought, and buy adplans
     Route::get('adsets', [FeatureController::class, 'index'])->name('adsets');   
     Route::post('subscription/features', [FeatureController::class, 'subscribe'])->name('feature.subscribe');   
     Route::post('feature/cancel-renewal', [FeatureController::class, 'cancel_renewal'])->name('feature.cancel_renew');   
     
    Route::get('generate/otp',[UserController::class, 'generate_otp'])->name('generate_otp');
    Route::post('edit-pin',[UserController::class, 'pin'])->name('edit-pin');

    Route::post('applycoupon',[PaymentController::class, 'apply'])->name('applycoupon');
    Route::get('transactions',[PaymentController::class,'index'])->name('payments');
    
    
    
    //list adds, create ads (both shop and products)
    Route::get('adverts/{feature}',[AdvertController::class,'ads'])->name('adverts');

    //create featured ads
    Route::post('feature/products',[AdvertController::class,'feature_products'])->name('feature.products');
    Route::post('feature/products/subscription',[AdvertController::class,'feature_products_subscription'])->name('feature.products.subscription');

    Route::post('adverts/product/filter',[AdvertController::class,'filter_products'])->name('advert.filter_product');
    Route::post('adverts/store/product',[AdvertController::class,'store_product_advert'])->name('advert.store.products');
    Route::post('adverts/store/shop',[AdvertController::class,'store_shop_advert'])->name('advert.store.shops');
    
    Route::post('adverts/manage',[AdvertController::class,'remove'])->name('advert.remove');
    
    
});