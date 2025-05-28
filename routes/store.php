<?php
use Illuminate\Support\Facades\URL;
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

Route::group(['prefix'=>'store','as'=>'store.'],function(){
    Route::view('create', 'store.settings.create')->name('create');
    Route::group(['prefix'=>'{store}'],function(){
        Route::view('dashboard', 'store.dashboard')->name('dashboard');

        Route::view('products', 'store.products.index')->name('products');
        Route::view('products/create', 'store.products.create')->name('products.create');

        Route::group(['prefix'=> 'marketing','as'=> 'marketing.'],function(){
            Route::view('bundles', 'store.marketing.bundles.index')->name('bundles');
            Route::view('bundles/create', 'store.marketing.bundles.create')->name('bundles.create');

            Route::view('giveaways', 'store.marketing.giveaways.index')->name('giveaways');
            Route::view('giveaways/create', 'store.marketing.giveaways.create')->name('giveaways.create');


            Route::view('adverts', 'store.marketing.adverts.index')->name('adverts');
            Route::view('adverts/plans', 'store.marketing.adverts.plans')->name('adverts.plans');
            Route::view('adverts/{adset}', 'store.marketing.adverts.show')->name('adverts.view');
            Route::view('adverts/create/{adset}', 'store.marketing.adverts.create')->name('adverts.create');
            

            Route::view('sales', 'store.marketing.sales.index')->name('sales');
            Route::view('sales/create', 'store.marketing.sales.create')->name('sales.create');

            Route::view('coupons', 'store.marketing.coupons.index')->name('coupons');
            Route::view('coupons/create', 'store.marketing.coupons.create')->name('coupons.create');

            Route::view('newsletters', 'store.marketing.newsletters.index')->name('newsletters');
            Route::view('newsletters/create', 'store.marketing.newsletters.create')->name('newsletters.create');
            Route::view('newsletters/templates', 'store.marketing.newsletters.template-selection')->name('newsletters.templates');
            Route::view('newsletters/preview/{template?}', 'store.marketing.newsletters.preview')->name('newsletters.preview');
            Route::view('newsletters/edit/{template?}', 'store.marketing.newsletters.edit')->name('newsletters.edit');
            
            Route::view('blog', 'store.marketing.blog.index')->name('blog');
            Route::view('blog/create', 'store.marketing.blog.create')->name('blog.create');
        });
        

        Route::view('orders', 'store.orders.index')->name('orders');
        Route::view('order/{order}', 'store.orders.show')->name('order');
        Route::view('order/{order}/disputes', 'store.orders.disputes')->name('order.disputes');
        Route::view('order/{order}/messages', 'store.orders.messages')->name('order.messages');
        Route::view('order/{order}/timeline', 'store.orders.timeline')->name('order.timeline');

        Route::view('disputes', 'store.disputes')->name('disputes');
        Route::view('notifications', 'store.notifications')->name('notifications');
        Route::view('media-library', 'store.media-library')->name('media-library');
        Route::view('reviews', 'store.reviews')->name('reviews');

        Route::view('support', 'store.support.index')->name('support');
        Route::view('support/create', 'store.support.create')->name('support.create');
        Route::view('support/{ticket}', 'store.support.show')->name('support.show');
        
        Route::view('support/help-center', 'store.support.help-center')->name('support.help-center');

        Route::view('earnings', 'store.earnings.index')->name('earnings');
        Route::view('earnings/withdrawals', 'store.earnings.withdrawals')->name('earnings.withdrawals');

        Route::view('analytics', 'store.analytics')->name('analytics');
        Route::view('notifications', 'store.notifications')->name('notifications');

        Route::view('settings', 'store.settings.edit')->name('settings');
        Route::view('settings/subscription', 'store.settings.subscription')->name('settings.subscription');
        Route::view('settings/notifications', 'store.settings.notifications')->name('settings.notifications');
        Route::view('settings/banking', 'store.settings.banking')->name('settings.banking');
        Route::view('settings/compliance', 'store.settings.compliance')->name('settings.compliance');
        Route::view('settings/team', 'store.settings.team')->name('settings.team');

    });
});
// Route::group(['prefix'=>'stores','as'=>'store.','middleware'=> ['auth:sanctum']],function (){
//     Route::post('store', [StoreController::class, 'store']);
//     Route::group(['middleware'=> 'workplace'],function (){
//         // 
//         Route::get('{store_id}', [StoreController::class, 'show']);
//         Route::post('import',[StoreController::class,'import']);
//         Route::post('update',[StoreController::class,'update']);
//         Route::post('delete',[StoreController::class,'destroy']);
//         Route::group(['prefix'=>'{store_id}'],function(){
//             Route::get('filemanager', function ($store_id) {  
//                 // Generate a signed URL valid for, for example, 5 minutes  
//                 $signedUrl = URL::temporarySignedRoute(  
//                     'unisharp.filemanager',        // Route name  
//                     now()->addMinutes(10),           // Expiration time  
//                     ['store_slug' => $store_id->slug,'type' => 'image'] // Route parameters  
//                 ); 
//                 return response()->json(['url' => $signedUrl]);  
//             });

//             Route::group(['prefix'=>'products'],function(){
//                 Route::get('/', [ProductController::class, 'index']);
//                 Route::post('store', [ProductController::class, 'store']);
//                 Route::post('update', [ProductController::class, 'update']);
//                 Route::post('destroy', [ProductController::class, 'destroy']);

//                 Route::post('upload', [ProductController::class, 'upload']);
//                 Route::get('download/template', [ProductController::class, 'template_download']);
                
//                 Route::group(['prefix'=>'sync'],function(){
//                     Route::post('wordpress', [ProductSyncController::class, 'wordpress'])->name('wordpress');
//                 });
//             });

//             Route::group(['prefix'=>'marketing'],function(){
//                 Route::group(['prefix'=>'bundles'],function(){
//                     Route::get('/', [ProductController::class, 'index']);
//                     Route::post('store', [ProductController::class, 'store']);
//                     Route::post('update', [ProductController::class, 'update']);
//                     Route::post('destroy', [ProductController::class, 'destroy']);
//                 });
//                 Route::group(['prefix'=>'sales'],function(){
//                     Route::get('/', [ProductController::class, 'index']);
//                     Route::post('store', [ProductController::class, 'store']);
//                     Route::post('update', [ProductController::class, 'update']);
//                     Route::post('destroy', [ProductController::class, 'destroy']);
//                 });
//                 Route::group(['prefix'=>'giveaway'],function(){
//                     Route::get('/', [ProductController::class, 'index']);
//                     Route::post('store', [ProductController::class, 'store']);
//                     Route::post('update', [ProductController::class, 'update']);
//                     Route::post('destroy', [ProductController::class, 'destroy']);
//                 });

//                 Route::group(['prefix'=>'coupon'],function(){
//                     Route::get('/', [ProductController::class, 'index']);
//                     Route::post('store', [ProductController::class, 'store']);
//                     Route::post('update', [ProductController::class, 'update']);
//                     Route::post('destroy', [ProductController::class, 'destroy']);
//                 });

//                 Route::group(['prefix'=>'newsletters'],function(){
//                     Route::get('/', [ProductController::class, 'index']);
//                     Route::post('store', [ProductController::class, 'store']);
//                     Route::post('update', [ProductController::class, 'update']);
//                     Route::post('destroy', [ProductController::class, 'destroy']);
//                 });

//                 Route::group(['prefix'=>'adsets'],function(){
//                     Route::get('/',[AdsetController::class,'index']);
//                     Route::get('plans',[AdsetController::class,'plans']);
//                     Route::post('subscribe',[AdsetController::class,'store']);
//                     Route::post('cancel_renewal',[AdsetController::class,'cancel_renewal']);
                    
//                     Route::post('ads/filter',[FeatureController::class,'filter_products']);
//                     Route::post('ads/store',[FeatureController::class,'store']);
//                     Route::post('ads/delete',[FeatureController::class,'remove']);
//                 });
            
//                 Route::group(['prefix'=>'ads'],function(){   
//                     Route::post('create', [AdsetController::class, 'create'])->name('adset.create');   
//                     Route::post('subscription/adsets', [AdsetController::class, 'subscribe'])->name('adset.subscribe');   
//                     Route::post('adset/cancel-renewal', [AdsetController::class, 'cancel_renewal'])->name('adset.cancel_renew');   
//                 });
//                 Route::get('adverts/{adset}',[AdvertController::class,'index'])->name('adverts');
//                 Route::get('adverts/create/{adset}',[AdvertController::class,'create'])->name('advert.create');
//                 Route::post('adverts/shop',[AdvertController::class,'shop'])->name('advert.shop');
//                 Route::get('adverts/edit/{advert}',[AdvertController::class,'edit'])->name('advert.edit');
//                 Route::post('adverts/update',[AdvertController::class,'update'])->name('advert.update');
//                 Route::post('adverts/remove',[AdvertController::class,'remove'])->name('advert.remove');
//                 Route::get('adpreview/{adset}/{advert}',[HomeController::class,'adpreview'])->name('adpreview');

//                 //shop featured adsets
//                 Route::get('featureds/{adset}',[FeatureController::class,'index'])->name('featureds');
//                 Route::post('featureds/shop',[FeatureController::class,'shop'])->name('featureds.shop');
//                 Route::post('feature/remove',[FeatureController::class,'remove'])->name('feature.remove');

//                 Route::post('feature/products',[FeatureController::class,'feature_products'])->name('feature.products');
//                 Route::post('feature/products/subscription',[FeatureController::class,'subscription'])->name('feature.products.subscription');
//                 Route::post('feature/products/filter',[FeatureController::class,'filter_products'])->name('feature.filter_product');
                
//                 //shop featured ads to adset
                
                
//                 //shop adverts to adsets

//             });

//             Route::group(['prefix'=>'orders'],function(){
//                 Route::get('/', [OrderController::class, 'index']);
//                 Route::post('update', [OrderController::class, 'update']);
//                 Route::post('destroy', [OrderController::class, 'destroy']);
//                 Route::post('message',[OrderController::class, 'message']);  
//                 Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
//             });

//             Route::group(['prefix'=>'reviews'],function(){
//                 Route::get('/', [OrderController::class, 'index']);
//                 Route::post('update', [OrderController::class, 'update']);
//                 Route::post('destroy', [OrderController::class, 'destroy']);
//                 Route::post('message',[OrderController::class, 'message']);  
//                 Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
//             });

//             Route::group(['prefix'=>'support'],function(){
//                 Route::get('/', [OrderController::class, 'index']);
//                 Route::post('update', [OrderController::class, 'update']);
//                 Route::post('destroy', [OrderController::class, 'destroy']);
//                 Route::post('message',[OrderController::class, 'message']);  
//                 Route::get('dispute',[OrderController::class, 'messages'])->name('order.messages');
//             });

//             Route::get('earnings',[PaymentController::class, 'earnings'])->name('earnings');

//             Route::group(['prefix'=>'payouts','as'=> 'payouts.'],function (){
//                 Route::get('/',[PaymentController::class, 'payouts'])->name('index');
//                 Route::post('store',[PaymentController::class, 'payout'])->name('store');
//                 Route::post('manage',[PaymentController::class, 'payout_manage'])->name('manage');
//             });

//             Route::get('settings',[StoreController::class, 'settings'])->name('settings');
//             Route::get('verification',[StoreController::class, 'verification'])->name('verification');
//             Route::post('verification',[StoreController::class, 'verify'])->name('verify');

//             Route::group(['prefix'=>'staff','as'=> 'staff.'],function (){
//                 Route::post('store',[StaffController::class, 'store'])->name('store');
//                 Route::post('update',[StaffController::class, 'update'])->name('update');
//                 Route::post('delete',[StaffController::class, 'destroy'])->name('destroy');
//             });
        
//             Route::get('analytics',[StoreController::class, 'notifications'])->name('analytics');
//             Route::post('subscription/plans', [SubscriptionController::class, 'subscribe'])->name('plans.subscribe');
//             Route::post('subscription/cancel-renewal', [SubscriptionController::class, 'cancel_renew'])->name('subscription.cancel_renew');   
//             Route::get('notifications',[StoreController::class, 'notifications'])->name('notifications');
//             Route::get('banking',[StaffController::class, 'banking'])->name('banking');
//             Route::post('bank_account_number_verification',[StaffController::class,'accountNumberResolve'])->name('account_number_verification');
//             Route::post('bank-info',[StaffController::class, 'bank_info'])->name('bank-info');

//             Route::group(['prefix'=>'subscription'],function (){
//                 Route::post('store',[SubscriptionController::class,'subscribe']);
//                 Route::post('cancel_renewal',[SubscriptionController::class,'cancel_renewal']);
//             });
    
//         });
//     });
// });
