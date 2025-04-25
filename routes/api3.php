<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Vendor\AdvertController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\SubscriptionController;

Route::group(['prefix'=> 'vendor','as'=>'vendor.','middleware'=> ['auth:sanctum','role:vendor,staff']],function () {
    Route::group(['middleware'=> 'role:vendor'],function(){
        Route::get('get-started',[StaffController::class, 'orientation'])->name('orientation');
        Route::get('dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        Route::post('kyc',[StaffController::class,'kyc'])->name('kyc');
        Route::get('banking',[StaffController::class, 'banking'])->name('banking');
        Route::post('bank_account_number_verification',[StaffController::class,'accountNumberResolve'])->name('account_number_verification');
        Route::post('bank-info',[StaffController::class, 'bank_info'])->name('bank-info');

        Route::get('shops', [StoreController::class, 'index'])->name('shops');
        Route::get('shop/create', [StoreController::class, 'create'])->name('shop.create');
        Route::post('shop/shop', [StoreController::class, 'shop'])->name('shop.shop');    
        Route::post('shop/update',[StoreController::class, 'update'])->name('shop.update');
        
        Route::get('plans',[SubscriptionController::class, 'plans'])->name('plans');
        Route::post('subscription/plans', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
        Route::post('subscription/cancel-renewal', [SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
        
        //adplans bought, and buy adplans
        Route::get('adsets', [AdsetController::class, 'index'])->name('adsets');   
        Route::get('adset/create', [AdsetController::class, 'create'])->name('adset.create');   
        Route::post('subscription/adsets', [AdsetController::class, 'subscribe'])->name('adset.subscribe');   
        Route::post('adset/cancel-renewal', [AdsetController::class, 'cancel_renewal'])->name('adset.cancel_renew');   

        
        Route::get('transactions',[PaymentController::class,'index'])->name('payments');
        
        //list adds, create ads (both shop and products)
        Route::get('adverts/{adset}',[AdvertController::class,'index'])->name('adverts');
        Route::get('adverts/create/{adset}',[AdvertController::class,'create'])->name('advert.create');
        Route::post('adverts/shop',[AdvertController::class,'shop'])->name('advert.shop');
        Route::get('adverts/edit/{advert}',[AdvertController::class,'edit'])->name('advert.edit');
        Route::post('adverts/update',[AdvertController::class,'update'])->name('advert.update');
        Route::post('adverts/remove',[AdvertController::class,'remove'])->name('advert.remove');


        //shop featured adsets
        Route::get('featureds/{adset}',[FeatureController::class,'index'])->name('featureds');
        Route::post('featureds/shop',[FeatureController::class,'shop'])->name('featureds.shop');
        Route::post('feature/remove',[FeatureController::class,'remove'])->name('feature.remove');

        Route::post('feature/products',[FeatureController::class,'feature_products'])->name('feature.products');
        Route::post('feature/products/subscription',[FeatureController::class,'subscription'])->name('feature.products.subscription');
        Route::post('feature/products/filter',[FeatureController::class,'filter_products'])->name('feature.filter_product');
        
        //shop featured ads to adset
        
        
        //shop adverts to adsets
        
        
        
        
    });  
});