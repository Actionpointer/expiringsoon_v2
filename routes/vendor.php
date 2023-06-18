<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Vendor\ShopController;
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

        Route::get('shops', [ShopController::class, 'index'])->name('shops');
        Route::get('shop/create', [ShopController::class, 'create'])->name('shop.create');
        Route::post('shop/store', [ShopController::class, 'store'])->name('shop.store');    
        Route::post('shop/update',[ShopController::class, 'update'])->name('shop.update');
        
        Route::get('plans',[SubscriptionController::class, 'plans'])->name('plans');
        Route::post('subscription/plans', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
        Route::post('subscription/cancel-renewal', [SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
        
        //adplans bought, and buy adplans
        Route::get('adsets', [AdsetController::class, 'index'])->name('adsets');   
        Route::get('adset/create', [AdsetController::class, 'create'])->name('adset.create');   
        Route::post('subscription/adsets', [AdsetController::class, 'subscribe'])->name('adset.subscribe');   
        Route::post('adset/cancel-renewal', [AdsetController::class, 'cancel_renewal'])->name('adset.cancel_renew');   

        Route::post('applycoupon',[PaymentController::class, 'apply'])->name('applycoupon');
        Route::get('transactions',[PaymentController::class,'index'])->name('payments');
        
        //list adds, create ads (both shop and products)
        Route::get('adverts/{adset}',[AdvertController::class,'index'])->name('adverts');
        Route::get('adverts/create/{adset}',[AdvertController::class,'create'])->name('advert.create');
        Route::post('adverts/store',[AdvertController::class,'store'])->name('advert.store');
        Route::get('adverts/edit/{advert}',[AdvertController::class,'edit'])->name('advert.edit');
        Route::post('adverts/update',[AdvertController::class,'update'])->name('advert.update');
        Route::post('adverts/remove',[AdvertController::class,'remove'])->name('advert.remove');


        //store featured adsets
        Route::post('adset/products',[FeatureController::class,'feature_products'])->name('adset.products');
        Route::post('adset/products/subscription',[FeatureController::class,'feature_products_subscription'])->name('adset.products.subscription');
        Route::post('adverts/product/filter',[FeatureController::class,'filter_products'])->name('advert.filter_product');
        
        //store featured ads to adset
        Route::post('adverts/store/product',[FeatureController::class,'store_featured_advert'])->name('advert.feature.products');
        Route::post('feature/manage',[FeatureController::class,'feature_remove'])->name('feature.remove');
        //store adverts to adsets
        
        
        
        
    });
    
    include('shop.php');
    
});