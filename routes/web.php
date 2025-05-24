<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::view('/welcome2', 'welcome2')->name('welcome2');
Route::view('/welcome3', 'welcome3')->name('welcome3');
Route::view('/welcome4', 'welcome4')->name('welcome4');
Route::view('/welcome5', 'welcome5')->name('welcome5');
Route::view('products', 'products')->name('products');
Route::view('products/{product}', 'product')->name('product');
Route::view('hotdeals', 'hotdeals')->name('hotdeals');
Route::view('stores', 'stores')->name('stores');
Route::view('stores/{store}', 'store')->name('store');
Route::view('cart', 'cart')->name('cart');
Route::view('compare', 'compare')->name('compare');

//customer
Route::view('checkout', 'checkout')->name('checkout');
Route::view('wishlist', 'wishlist')->name('wishlist');
Route::view('dashboard', 'dashboard')->name('dashboard');
Route::view('profile', 'profile')->name('profile');
Route::view('addresses', 'addresses')->name('addresses');
Route::view('followings', 'followings')->name('followings');
Route::view('orders', 'orders')->name('orders');
Route::view('order/{order}', 'order')->name('order');
Route::view('order/{order}/disputes', 'disputes')->name('dispute');
Route::view('order/{order}/messages', 'messages')->name('messages');
Route::view('order/{order}/timeline', 'timeline')->name('timeline');
Route::view('mystores', 'mystores')->name('mystores');

//store
Route::view('store/create', 'store.create')->name('store.create');

Route::view('store/dashboard', 'store.dashboard')->name('store.dashboard');

Route::view('store/products', 'store.products')->name('store.products');
Route::view('store/products/create', 'store.products.create')->name('store.products.create');

Route::view('store/marketing/bundles', 'store.marketing.bundles')->name('store.marketing.bundles');
Route::view('store/marketing/bundles/create', 'store.marketing.bundles.create')->name('store.marketing.bundles.create');

Route::view('store/marketing/giveaways', 'store.marketing.giveaways')->name('store.marketing.giveaways');
Route::view('store/marketing/giveaways/create', 'store.marketing.giveaways.create')->name('store.marketing.giveaways.create');

Route::view('store/marketing/ads', 'store.marketing.ads')->name('store.marketing.ads');
Route::view('store/marketing/ads/create', 'store.marketing.ads.create')->name('store.marketing.ads.create');

Route::view('store/marketing/sales', 'store.marketing.sales')->name('store.marketing.sales');
Route::view('store/marketing/sales/create', 'store.marketing.sales.create')->name('store.marketing.sales.create');

Route::view('store/marketing/coupons', 'store.marketing.coupons')->name('store.marketing.coupons');
Route::view('store/marketing/coupons/create', 'store.marketing.coupons.create')->name('store.marketing.coupons.create');

Route::view('store/marketing/newsletters', 'store.marketing.newsletters')->name('store.marketing.newsletters');
Route::view('store/marketing/newsletters/create', 'store.marketing.newsletters.create')->name('store.marketing.newsletters.create');

Route::view('store/orders', 'store.orders')->name('store.orders');
Route::view('store/order/{order}', 'store.order')->name('store.order');
Route::view('store/order/{order}/disputes', 'store.order.disputes')->name('store.order.disputes');
Route::view('store/order/{order}/messages', 'store.order.messages')->name('store.order.messages');
Route::view('store/order/{order}/timeline', 'store.order.timeline')->name('store.order.timeline');

Route::view('store/reviews', 'store.reviews')->name('store.reviews');
Route::view('store/support', 'store.support')->name('store.support');
Route::view('store/support/tickets', 'store.support.tickets')->name('store.support.tickets');
Route::view('store/support/tickets/create', 'store.support.tickets.create')->name('store.support.tickets.create');

Route::view('store/earnings', 'store.earnings')->name('store.earnings');
Route::view('store/analytics', 'store.analytics')->name('store.analytics');

Route::view('store/settings', 'store.settings')->name('store.settings');
Route::view('store/settings/subscription', 'store.settings.subscription')->name('store.settings.subscription');
Route::view('store/settings/bank-details', 'store.settings.bank-details')->name('store.settings.bank-details');
Route::view('store/settings/compliance', 'store.settings.compliance')->name('store.settings.compliance');
Route::view('store/settings/team', 'store.settings.team')->name('store.settings.team');


Route::group(['middleware'=>'auth'],function(){
    include('customer.php');
    include('store.php');
});



Route::group(['prefix' => 'store-filemanager/', 'middleware' => ['web','vendor']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['web','signed'])->get('filemanager', function () {
    session(['store_slug' => request()->store_slug]);
    return redirect('/store-filemanager');
})->name('unisharp.filemanager');








