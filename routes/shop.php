<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
   
Route::group(['prefix'=>'vendor/{shop}','as'=> 'shop.'],function (){
    Route::get('dashboard', [App\Http\Controllers\ShopController::class, 'dashboard'])->name('dashboard');
    Route::get('settings',[App\Http\Controllers\ShopController::class, 'settings'])->name('settings');
    Route::post('profile',[App\Http\Controllers\ShopController::class, 'profile'])->name('profile');
    Route::post('address',[App\Http\Controllers\ShopController::class, 'address'])->name('address');
    Route::post('discounts',[App\Http\Controllers\ShopController::class, 'discounts'])->name('discounts');
    Route::post('kyc',[App\Http\Controllers\ShopController::class, 'kyc'])->name('kyc');
    Route::post('staff',[App\Http\Controllers\ShopController::class, 'staff'])->name('staff');
    Route::post('shipping',[App\Http\Controllers\ShopController::class, 'shipping'])->name('shipping');
    

    
    Route::get('payouts',[App\Http\Controllers\PayoutController::class, 'index'])->name('payouts');
    Route::post('bank-info',[App\Http\Controllers\PayoutController::class, 'bank_info'])->name('bank-info');
    Route::post('payout',[App\Http\Controllers\PayoutController::class, 'payout'])->name('payout');
    
  
    Route::get('notifications',[App\Http\Controllers\ShopController::class, 'notifications'])->name('notifications');
    Route::get('products', [App\Http\Controllers\ProductController::class, 'list'])->name('product.list');
    Route::get('product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::post('product/manage', [App\Http\Controllers\ProductController::class, 'manage'])->name('products.manage');

    Route::get('orders', [App\Http\Controllers\OrderController::class, 'shop_orders'])->name('order.list');
    Route::get('order/{order}', [App\Http\Controllers\OrderController::class, 'shop_order_view'])->name('order.view');
    Route::post('order/manage', [App\Http\Controllers\OrderController::class, 'manage'])->name('order.manage');
    Route::get('payments',[App\Http\Controllers\PaymentController::class, 'shop_index'])->name('payments');
});
