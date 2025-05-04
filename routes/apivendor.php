<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\AdvertController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ProductSyncController;

use App\Http\Controllers\Vendor\SubscriptionController;

Route::group(['prefix'=>'stores'],function (){
    Route::post('store', [StoreController::class, 'store']);
    Route::group(['middleware'=> 'workplace'],function (){
        Route::get('/', [StoreController::class, 'index']);
        Route::get('{store_id}', [StoreController::class, 'show']);
        Route::post('import',[StoreController::class,'import']);
        Route::post('update',[StoreController::class,'update']);
        Route::post('delete',[StoreController::class,'destroy']);
        
        Route::group(['prefix'=>'products'],function(){
            Route::get('/', [ProductController::class, 'index']);
            Route::post('store', [ProductController::class, 'store']);
            Route::post('update', [ProductController::class, 'update']);
            Route::post('destroy', [ProductController::class, 'destroy']);
            Route::post('upload', [ProductController::class, 'upload']);
            Route::get('download/template', [ProductController::class, 'template_download']);
            
            Route::group(['prefix'=>'sync'],function(){
                Route::post('wordpress', [ProductSyncController::class, 'wordpress'])->name('wordpress');
            });
        });

        Route::group(['prefix'=>'marketing'],function(){
            Route::group(['prefix'=>'bundles'],function(){
                Route::get('/', [ProductController::class, 'index']);
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::post('destroy', [ProductController::class, 'destroy']);
            });
            Route::group(['prefix'=>'sales'],function(){
                Route::get('/', [ProductController::class, 'index']);
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::post('destroy', [ProductController::class, 'destroy']);
            });
            Route::group(['prefix'=>'giveaway'],function(){
                Route::get('/', [ProductController::class, 'index']);
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::post('destroy', [ProductController::class, 'destroy']);
            });

            Route::group(['prefix'=>'coupon'],function(){
                Route::get('/', [ProductController::class, 'index']);
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::post('destroy', [ProductController::class, 'destroy']);
            });

            Route::group(['prefix'=>'newsletters'],function(){
                Route::get('/', [ProductController::class, 'index']);
                Route::post('store', [ProductController::class, 'store']);
                Route::post('update', [ProductController::class, 'update']);
                Route::post('destroy', [ProductController::class, 'destroy']);
            });

            Route::group(['prefix'=>'adsets'],function(){
                Route::get('/',[AdsetController::class,'index']);
                Route::get('plans',[AdsetController::class,'plans']);
                Route::post('subscribe',[AdsetController::class,'store']);
                Route::post('cancel_renewal',[AdsetController::class,'cancel_renewal']);
                
                Route::post('ads/filter',[FeatureController::class,'filter_products']);
                Route::post('ads/store',[FeatureController::class,'store']);
                Route::post('ads/delete',[FeatureController::class,'remove']);
            });
        
            Route::group(['prefix'=>'ads'],function(){   
                Route::post('create', [AdsetController::class, 'create'])->name('adset.create');   
                Route::post('subscription/adsets', [AdsetController::class, 'subscribe'])->name('adset.subscribe');   
                Route::post('adset/cancel-renewal', [AdsetController::class, 'cancel_renewal'])->name('adset.cancel_renew');   
            });
            Route::get('adverts/{adset}',[AdvertController::class,'index'])->name('adverts');
            Route::get('adverts/create/{adset}',[AdvertController::class,'create'])->name('advert.create');
            Route::post('adverts/shop',[AdvertController::class,'shop'])->name('advert.shop');
            Route::get('adverts/edit/{advert}',[AdvertController::class,'edit'])->name('advert.edit');
            Route::post('adverts/update',[AdvertController::class,'update'])->name('advert.update');
            Route::post('adverts/remove',[AdvertController::class,'remove'])->name('advert.remove');
            Route::get('adpreview/{adset}/{advert}',[HomeController::class,'adpreview'])->name('adpreview');

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

        Route::group(['prefix'=>'orders'],function(){
            Route::get('/', [OrderController::class, 'index']);
            Route::post('update', [OrderController::class, 'update']);
            Route::post('destroy', [OrderController::class, 'destroy']);
            Route::post('message',[OrderController::class, 'message']);  
            Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
        });

        Route::group(['prefix'=>'reviews'],function(){
            Route::get('/', [OrderController::class, 'index']);
            Route::post('update', [OrderController::class, 'update']);
            Route::post('destroy', [OrderController::class, 'destroy']);
            Route::post('message',[OrderController::class, 'message']);  
            Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
        });

        Route::group(['prefix'=>'support'],function(){
            Route::get('/', [OrderController::class, 'index']);
            Route::post('update', [OrderController::class, 'update']);
            Route::post('destroy', [OrderController::class, 'destroy']);
            Route::post('message',[OrderController::class, 'message']);  
            Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
        });

        Route::get('earnings',[PaymentController::class, 'earnings'])->name('earnings');

        Route::group(['prefix'=>'payouts','as'=> 'payouts.'],function (){
            Route::get('/',[PaymentController::class, 'payouts'])->name('index');
            Route::post('store',[PaymentController::class, 'payout'])->name('store');
            Route::post('manage',[PaymentController::class, 'payout_manage'])->name('manage');
        });

        Route::get('settings',[StoreController::class, 'settings'])->name('settings');
        Route::get('verification',[StoreController::class, 'verification'])->name('verification');
        Route::post('verification',[StoreController::class, 'verify'])->name('verify');

        Route::group(['prefix'=>'staff','as'=> 'staff.'],function (){
            Route::post('store',[StaffController::class, 'store'])->name('store');
            Route::post('update',[StaffController::class, 'update'])->name('update');
            Route::post('delete',[StaffController::class, 'destroy'])->name('destroy');
        });
    
        Route::get('analytics',[StoreController::class, 'notifications'])->name('notifications');
        Route::post('subscription/plans', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
        Route::post('subscription/cancel-renewal', [SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
        Route::get('notifications',[StoreController::class, 'notifications'])->name('notifications');
        Route::get('banking',[StaffController::class, 'banking'])->name('banking');
        Route::post('bank_account_number_verification',[StaffController::class,'accountNumberResolve'])->name('account_number_verification');
        Route::post('bank-info',[StaffController::class, 'bank_info'])->name('bank-info');

        Route::group(['prefix'=>'subscription'],function (){
            Route::post('store',[SubscriptionController::class,'subscribe']);
            Route::post('cancel_renewal',[SubscriptionController::class,'cancel_renewal']);
        });
    
    });
});
