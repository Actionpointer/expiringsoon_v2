<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ShipmentController;

   
Route::group(['prefix'=>'{shop}','as'=> 'shop.','middleware'=> 'forcepassword'],function (){
    Route::get('dashboard', [ShopController::class, 'show'])->name('show');
    Route::get('settings',[ShopController::class, 'settings'])->name('settings');
    // Route::post('address',[ShopController::class, 'address'])->name('address');
    // Route::post('discounts',[ShopController::class, 'discounts'])->name('discounts');
    
    Route::post('shipping/store',[ShipmentController::class, 'store'])->name('shipping.store');
    Route::post('shipping/update',[ShipmentController::class,'update'])->name('shipping.update');
    Route::post('shipping/delete',[ShipmentController::class,'delete'])->name('shipping.delete');

    Route::post('staff/store',[StaffController::class, 'store'])->name('staff.store');
    Route::post('staff/update',[StaffController::class, 'update'])->name('staff.update');
    Route::post('staff/delete',[StaffController::class, 'destroy'])->name('staff.destroy');
    

    Route::get('earnings',[PaymentController::class, 'earnings'])->name('earnings');
    Route::get('payouts',[PaymentController::class, 'payouts'])->name('payouts');
    
    Route::post('payout',[PaymentController::class, 'payout'])->name('payout');
    
  
    Route::get('notifications',[ShopController::class, 'notifications'])->name('notifications');
    Route::get('products', [ProductController::class, 'index'])->name('product.list');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('product/manage', [ProductController::class, 'manage'])->name('products.manage');

    Route::get('orders/{status?}', [OrderController::class, 'index'])->name('order.list');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('order.view');
    Route::post('order/update', [OrderController::class, 'update'])->name('order.update');
    
    // Route::get('order/{order}/messages',[OrderController::class, 'messages'])->name('order.messages');
    Route::post('order/message',[OrderController::class, 'message'])->name('order.message');    
    
});
