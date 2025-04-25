<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ShipmentController;
use App\Http\Controllers\Vendor\ProductSyncController;

   
Route::group(['prefix'=>'{shop}','as'=> 'shop.','middleware'=> 'forcepassword'],function (){
    Route::get('dashboard', [StoreController::class, 'show'])->name('show');
    Route::get('settings',[StoreController::class, 'settings'])->name('settings');
    Route::get('verification',[StoreController::class, 'verification'])->name('verification');
    Route::post('verification',[StoreController::class, 'verify'])->name('verify');

    
    Route::get('shipping',[ShipmentController::class, 'index'])->name('shipping');
    Route::post('shipping/package/rate',[ShipmentController::class,'package_rate'])->name('shipping.package');
    Route::post('shipping/shop',[ShipmentController::class, 'shop'])->name('shipping.shop');
    Route::post('shipping/update',[ShipmentController::class,'update'])->name('shipping.update');
    Route::post('shipping/delete',[ShipmentController::class,'delete'])->name('shipping.delete');

    Route::post('staff/shop',[StaffController::class, 'shop'])->name('staff.shop');
    Route::post('staff/update',[StaffController::class, 'update'])->name('staff.update');
    Route::post('staff/delete',[StaffController::class, 'destroy'])->name('staff.destroy');
    

    Route::get('earnings',[PaymentController::class, 'earnings'])->name('earnings');
    Route::get('payouts',[PaymentController::class, 'payouts'])->name('payouts');
    
    Route::post('payout',[PaymentController::class, 'payout'])->name('payout');
    Route::post('payout/manage',[PaymentController::class, 'payout_manage'])->name('payout.manage');
    
  
    Route::get('notifications',[StoreController::class, 'notifications'])->name('notifications');
    Route::get('products', [ProductController::class, 'index'])->name('product.list');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/shop', [ProductController::class, 'shop'])->name('product.shop');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('product/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('product/upload', [ProductController::class, 'upload'])->name('product.upload');
    Route::post('product/upload_file', [ProductController::class, 'product_upload'])->name('product.upload_file');
    Route::get('product/template/download', [ProductController::class, 'template_download'])->name('product.template');
    
    Route::group(['prefix'=>'product/sync','as'=> 'product.sync.'],function(){
        Route::get('/', [ProductSyncController::class, 'index'])->name('index');
        Route::post('wordpress', [ProductSyncController::class, 'wordpress'])->name('wordpress');
    });

    Route::get('orders/{status?}', [OrderController::class, 'index'])->name('order.list');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('order.view');
    Route::post('order/update', [OrderController::class, 'update'])->name('order.update');
    
    // Route::get('order/{order}/messages',[OrderController::class, 'messages'])->name('order.messages');
    Route::post('order/message',[OrderController::class, 'message'])->name('order.message');    
    
});
