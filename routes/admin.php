<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'admin','as'=>'admin.','middleware'=> 'role:admin,customercare,security,auditor'],function(){
    Route::get('dashboard',[App\Http\Controllers\HomeController::class, 'admin'])->name('dashboard');
    Route::get('settings',[App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('settings',[App\Http\Controllers\SettingsController::class, 'settings'])->name('settings');
    Route::post('shipping-rates',[App\Http\Controllers\SettingsController::class, 'shipping_rates'])->name('shipments');
    Route::post('staff',[App\Http\Controllers\SettingsController::class, 'admins'])->name('staff');
    Route::post('plans',[App\Http\Controllers\SettingsController::class, 'plans'])->name('plans');
    Route::post('adplans',[App\Http\Controllers\SettingsController::class, 'adplans'])->name('adplans');
    
    Route::get('subscriptions',[App\Http\Controllers\SubscriptionController::class, 'admin_index'])->name('subscriptions');
    Route::post('subscriptions',[App\Http\Controllers\SubscriptionController::class, 'update'])->name('subscriptions');
    
    Route::get('categories',[App\Http\Controllers\SettingsController::class, 'categories'])->name('categories');
    Route::post('categories',[App\Http\Controllers\SettingsController::class, 'categories_management'])->name('categories.management');
    
    
    Route::get('shops', [App\Http\Controllers\ShopController::class, 'admin_index'])->name('shops');
    Route::get('shop/manage/{shop}', [App\Http\Controllers\ShopController::class, 'admin_view'])->name('shop.show');
    Route::post('shop/management', [App\Http\Controllers\ShopController::class, 'admin_manage'])->name('shop.manage');
    Route::post('shop/manage', [App\Http\Controllers\ShopController::class, 'admin_kyc'])->name('kyc.manage');
    
    Route::get('products',[App\Http\Controllers\ProductController::class, 'admin_index'])->name('products');
    Route::post('products',[App\Http\Controllers\ProductController::class, 'admin_manage'])->name('products.manage');
    Route::get('orders',[App\Http\Controllers\OrderController::class, 'admin_index'])->name('orders');
    Route::post('orders',[App\Http\Controllers\OrderController::class, 'admin_manage'])->name('order.manage');
    
    Route::get('payouts',[App\Http\Controllers\PayoutController::class, 'admin_index'])->name('payouts');
    Route::post('payouts',[App\Http\Controllers\PayoutController::class, 'admin_manage'])->name('payouts.manage');
    Route::get('adverts',[App\Http\Controllers\AdvertController::class, 'admin_index'])->name('adverts');
    Route::post('adverts',[App\Http\Controllers\AdvertController::class, 'admin_manage'])->name('adverts.manage');
    Route::get('payments',[App\Http\Controllers\PaymentController::class, 'admin_index'])->name('payments');
    
    Route::get('users',[App\Http\Controllers\UserController::class, 'users'])->name('users');
    Route::get('users/show/{user}',[App\Http\Controllers\UserController::class, 'user_show'])->name('user.show');
    Route::post('users',[App\Http\Controllers\UserController::class, 'user_manage'])->name('user.manage');

    Route::get('messages',[App\Http\Controllers\MessageController::class, 'admin_index'])->name('messages');
    Route::get('message/{user}',[App\Http\Controllers\MessageController::class, 'admin_conversation'])->name('message');
    Route::post('message/{user}',[App\Http\Controllers\MessageController::class, 'admin_createConversation'])->name('message');
    Route::get('shipping',[App\Http\Controllers\ShipmentController::class, 'shipping'])->name('shipping');
    Route::get('security',[App\Http\Controllers\SecurityController::class, 'index'])->name('security');
});