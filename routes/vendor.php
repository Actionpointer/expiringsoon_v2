<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\AdvertController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\SubscriptionController;
use App\Http\Controllers\Vendor\StaffController;

Route::group(['prefix'=> 'vendor','as'=>'vendor.','middleware'=> ['auth:sanctum','role:vendor']],function () {
    Route::get('get-started',[StaffController::class, 'orientation'])->name('orientation');
    Route::get('dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::post('kyc',[StaffController::class,'kyc'])->name('kyc');
    Route::get('notifications',[StaffController::class, 'notifications'])->name('notifications');
    Route::post('notifications/read',[StaffController::class, 'readNotifications'])->name('notifications.read');

    Route::get('banking',[StaffController::class, 'banking'])->name('banking');
    Route::post('bank-account_number_verification',[StaffController::class,'accountNumberResolve'])->name('account_number_verification');
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
    Route::get('adverts/{adset}',[AdvertController::class,'ads'])->name('adverts');

    //create adsetd ads
    Route::post('adset/products',[AdvertController::class,'adset_products'])->name('adset.products');
    Route::post('adset/products/subscription',[AdvertController::class,'adset_products_subscription'])->name('adset.products.subscription');

    Route::post('adverts/product/filter',[AdvertController::class,'filter_products'])->name('advert.filter_product');
    Route::post('adverts/store/product',[AdvertController::class,'store_product_advert'])->name('advert.store.products');
    Route::post('adverts/store/shop',[AdvertController::class,'store_shop_advert'])->name('advert.store.shops');
    
    Route::post('adverts/manage',[AdvertController::class,'remove'])->name('advert.remove');
    include('shop.php');
    
});