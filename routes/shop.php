<?php
use Illuminate\Support\Facades\Route;

Route::name('shop.')->group(function () {
    Route::get('vendor/shops', [App\Http\Controllers\ShopController::class, 'list'])->name('list');
    Route::get('vendor/shop/create', [App\Http\Controllers\ShopController::class, 'create'])->name('create');
    Route::post('vendor/shop/store', [App\Http\Controllers\ShopController::class, 'store'])->name('store');
    Route::prefix('vendor/{shop}')->group(function (){
        Route::get('dashboard', [App\Http\Controllers\ShopController::class, 'dashboard'])->name('dashboard');
        Route::get('settings',[App\Http\Controllers\ShopController::class, 'settings'])->name('settings');
        Route::post('edit-address',[App\Http\Controllers\SettingsController::class, 'address'])->name('edit-address');
        Route::get('payouts',[App\Http\Controllers\PaymentController::class, 'index'])->name('payouts');
        Route::post('payout',[App\Http\Controllers\PaymentController::class, 'payout'])->name('payout');
        Route::post('discounts',[App\Http\Controllers\SettingsController::class, 'discounts'])->name('discounts');

        Route::get('products', [App\Http\Controllers\ProductController::class, 'list'])->name('product.list');
        Route::get('product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
        Route::post('product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('product/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::post('product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::post('product/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
        Route::get('sales', [App\Http\Controllers\OrderController::class, 'sales'])->name('order.list');

    });
    
    

});