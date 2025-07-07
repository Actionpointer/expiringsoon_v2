<?php

use App\Livewire\Store\StoreCreate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Livewire\Store\StoreDashboard;
use App\Livewire\Store\Subscription\Plans;
use App\Livewire\Store\Product\ProductEdit;
use App\Livewire\Store\Product\ProductList;
use App\Livewire\Store\Settings\Compliance;
use App\Livewire\Store\Settings\TeamMembers;
use App\Livewire\Store\Product\ProductCreate;
use App\Livewire\Store\Settings\StoreDetails;
use App\Livewire\Store\Marketing\Sales\SalesEdit;
use App\Livewire\Store\Marketing\Sales\SalesList;
use App\Livewire\Store\Settings\StoreBankAccount;
use App\Livewire\Store\Settings\StoreSubscription;
use App\Livewire\Store\Marketing\Advert\AdvertList;
use App\Livewire\Store\Marketing\Bundle\BundleList;
use App\Livewire\Store\Marketing\Coupon\CouponEdit;
use App\Livewire\Store\Marketing\Coupon\CouponList;
use App\Livewire\Store\Marketing\Sales\SalesCreate;
use App\Livewire\Store\Marketing\Bundle\BundleCreate;
use App\Livewire\Store\Marketing\Coupon\CouponCreate;
use App\Livewire\Store\Settings\StoreNotificationPage;
use App\Livewire\Store\Marketing\Giveaway\GiveawayEdit;
use App\Livewire\Store\Marketing\Giveaway\GiveawayList;
use App\Livewire\Store\Marketing\Giveaway\GiveawayCreate;

Route::group(['prefix'=>'store','as'=>'store.'],function(){
    Route::get('create', StoreCreate::class)->name('create');
 
    Route::group(['prefix'=>'{store}'],function(){
        Route::get('plans',Plans::class )->name('plans');

        Route::group(['middleware'=> ['auth']],function(){

            Route::get('dashboard', StoreDashboard::class)->name('dashboard');

            Route::get('filemanager', function ($store) {  
                // Generate a signed URL valid for, for example, 5 minutes  
                $signedUrl = URL::temporarySignedRoute(  
                    'unisharp.filemanager',        // Route name  
                    now()->addMinutes(10),           // Expiration time  
                    ['store_slug' => $store,'type' => 'image'] // Route parameters  
                ); 
                return redirect()->to($signedUrl);  
            })->name('filemanager');

            Route::get('products', ProductList::class)->name('products');
            Route::get('products/create', ProductCreate::class)->name('products.create');
            Route::get('products/edit/{product}', ProductEdit::class)->name('products.edit');

            Route::group(['prefix'=> 'marketing','as'=> 'marketing.'],function(){
                Route::get('bundles', BundleList::class)->name('bundles');
                Route::get('bundles/create', BundleCreate::class)->name('bundles.create');
                Route::get('bundles/edit/{bundle}', BundleCreate::class)->name('bundles.edit');

                Route::get('sales', SalesList::class)->name('sales');
                Route::get('sales/create', SalesCreate::class)->name('sales.create');
                Route::get('sales/edit/{sale}', SalesEdit::class)->name('sales.edit');

                Route::get('giveaways', GiveawayList::class)->name('giveaways');
                Route::get('giveaways/create', GiveawayCreate::class)->name('giveaways.create');
                Route::get('giveaways/edit/{giveaway', GiveawayEdit::class)->name('giveaways.edit');

                Route::get('coupons', CouponList::class)->name('coupons');
                Route::get('coupons/create', CouponCreate::class)->name('coupons.create');
                Route::get('coupons/edit/{coupon}', CouponEdit::class)->name('coupons.edit');

                Route::get('adverts', AdvertList::class)->name('adverts');
                Route::view('adverts/plans', 'store.marketing.adverts.plans')->name('adverts.plans');
                Route::view('adverts/{adset}', 'store.marketing.adverts.show')->name('adverts.view');
                Route::view('adverts/create/{adset}', 'store.marketing.adverts.create')->name('adverts.create');
                
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
            Route::view('support/ticket/{ticket}', 'store.support.show')->name('support.show');
            
            Route::view('support/help-center', 'store.support.help-center')->name('support.help-center');

            Route::view('earnings', 'store.earnings.index')->name('earnings');
            Route::view('earnings/withdrawals', 'store.earnings.withdrawals')->name('earnings.withdrawals');

            Route::view('analytics', 'store.analytics')->name('analytics');
            Route::view('notifications', 'store.notifications')->name('notifications');

            Route::get('settings', StoreDetails::class)->name('settings');
            Route::get('settings/notifications', StoreNotificationPage::class)->name('settings.notifications');
            Route::get('settings/subscription', StoreSubscription::class)->name('settings.subscription');
            
            Route::get('settings/banking', StoreBankAccount::class)->name('settings.banking');
            Route::get('settings/compliance', Compliance::class)->name('settings.compliance');
            Route::get('settings/team', TeamMembers::class)->name('settings.team');

        });
    });
});
