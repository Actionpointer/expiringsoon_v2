<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Auth\ApyController;
use App\Http\Controllers\Guest\ProductController;
use App\Http\Controllers\Shopper\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('register', [ApyController::class, 'register']);
Route::post('login', [ApyController::class, 'login']);                                               
Route::get('products',[ProductController::class,'list']);
Route::get('product/{product_id}',[ProductController::class,'show']);

Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::get('/',function(Request $request){
            return new CustomerResource(User::findOrFail($request->user()->id));
        });
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
    });
    Route::get('wishlist', [OrderController::class, 'wishlist'])->name('wishlist');
    Route::get('notifications',[UserController::class, 'notifications']);
    Route::get('generate/otp',[UserController::class, 'generate_otp'])->name('generate_otp');
    Route::post('edit-pin',[UserController::class, 'pin'])->name('edit-pin');
    Route::get('addresses', [UserController::class, 'addresses'])->name('addresses');
    Route::post('address',[UserController::class, 'address'])->name('address');
    
    Route::get('checkout/{shop?}',[OrderController::class,'checkout'])->name('checkout');
    Route::post('checkout/getshipment',[OrderController::class,'shipment'])->name('checkout.shipment');
    Route::post('checkout/confirm',[OrderController::class,'confirmcheckout'])->name('confirmcheckout');

    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('order/{order}',[OrderController::class, 'show'])->name('order.show');
    Route::post('order/update',[OrderController::class, 'update'])->name('order.update');
    // Route::get('transactions',[OrderController::class,'transactions'])->name('payments');
    Route::post('order/review',[OrderController::class, 'review'])->name('order.review');

    // Route::get('order/{order}/messages',[OrderController::class, 'messages'])->name('order.messages');
    Route::post('order/message',[OrderController::class, 'message'])->name('order.message');
    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('transactions',[PaymentController::class, 'index']);
        
    });

    
});
