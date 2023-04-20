<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Auth\ApyController;
use App\Http\Controllers\Guest\CartController;
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
Route::get('hotdeals',[ProductController::class, 'hotdeals']);

Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::get('/',function(Request $request){
            return new CustomerResource(User::findOrFail($request->user()->id));
        });
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
    });
    Route::get('wishlist', [OrderController::class, 'wishlist']);
    Route::post('wishlist/add',[CartController::class,'addtowish']);
    Route::post('wishlist/remove',[CartController::class,'removefromwish']);

    Route::get('cart', [CartController::class, 'cart']);
    Route::post('cart/add',[CartController::class,'addtocart']);
    Route::post('cart/remove',[CartController::class,'removefromcart']);
    
    Route::get('addresses', [AddressController::class,'index']);
    Route::post('address/store',[AddressController::class,'store']);
    Route::post('address/update',[AddressController::class,'update']);
    Route::post('address/delete',[AddressController::class,'destroy']);

    Route::get('order/{order}',[OrderController::class, 'show']);
    Route::post('order/update',[OrderController::class, 'update']); 
    // Route::get('adverts/products',)
    Route::get('notifications',[UserController::class, 'notifications']);
    Route::get('generate/otp',[UserController::class, 'generate_otp']);
    Route::post('edit-pin',[UserController::class, 'pin']);
    
    
    Route::get('checkout/{shop?}',[OrderController::class,'checkout']);
    Route::post('checkout/getshipment',[OrderController::class,'shipment']);
    Route::post('checkout/confirm',[OrderController::class,'confirmcheckout']);

    Route::get('orders', [OrderController::class, 'index']);

    
    // Route::get('transactions',[OrderController::class,'transactions'])->name('payments');
    Route::post('order/review',[OrderController::class, 'review']);

    // Route::get('order/{order}/messages',[OrderController::class, 'messages'])->name('order.messages');
    Route::post('order/message',[OrderController::class, 'message']);
    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('transactions',[PaymentController::class, 'index']);
        
    });

    
});
