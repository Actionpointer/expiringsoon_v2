<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\ResourcesController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Customer\SalesController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Customer\AddressController;


Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::post('signout',[LoginController::class,'signOut']);

    Route::group(['prefix'=> 'user'],function(){
        Route::get('/',function(){ return new CustomerResource(User::findOrFail(request()->user()->id));});
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
        Route::get('notifications',[UserController::class,'notifications']);
        Route::get('updates',[UserController::class,'notifications']);
        Route::post('notifications/read',[UserController::class,'readNotifications']);
    });

    Route::group(['prefix'=> 'otp','as'=> 'otp.','middleware'=> ['auth']],function(){
        Route::get('/',[HomeController::class, 'otp_request']);
        Route::get('send',[HomeController::class,'otp_send']);
        Route::post('verify',[HomeController::class,'otp_verify']);
    });

    Route::group(['prefix'=>'orders'],function(){
        Route::get('/', [OrderController::class, 'index']);
        Route::get('show/{order}', [OrderController::class, 'index']);
        Route::post('update', [OrderController::class, 'update']);
        Route::post('destroy', [OrderController::class, 'destroy']);
        Route::post('message',[OrderController::class, 'message']);  
        Route::get('dispute',[OrderController::class, 'messages']);
        Route::get('orders/{order_id}/messages',[OrderController::class,'messages']);
        Route::post('order/message',[OrderController::class, 'message']);
        Route::post('order/review',[ReviewController::class, 'review']);
    });  

    Route::group(['prefix'=>'payment'],function(){
        Route::post('status',[App\Http\Controllers\PaymentController::class,'paymentcallback']);
    });

    Route::group(['prefix'=>'address'],function(){
        Route::get('/', [AddressController::class, 'index']);
        Route::post('store', [AddressController::class, 'update']);
        Route::post('update', [AddressController::class, 'update']);
        Route::post('destroy', [AddressController::class, 'destroy']); 
    });

    Route::group(['prefix'=> 'followers'],function(){
        Route::get('/', [SalesController::class, 'index']);
        Route::post('follow', [SalesController::class, 'store']);
        Route::post('unfollow', [SalesController::class, 'update']);
    });
    
    Route::get('wishlist', [SalesController::class, 'wishlist']);
    Route::post('wishlist/add',[CartController::class,'addtowish']);
    Route::post('wishlist/remove',[CartController::class,'removefromwish']);

    Route::get('cart', [CartController::class, 'cart']);
    Route::post('cart/add',[CartController::class,'addtocart']);
    Route::post('cart/remove',[CartController::class,'removefromcart']);

    Route::post('checkout',[SalesController::class,'checkout_api']);
    Route::post('checkout/confirm',[SalesController::class,'confirmcheckout_api']);

    Route::post('applycoupon',[ResourcesController::class, 'coupon']);

    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('/',[PaymentController::class, 'index']);    
        Route::get('view/{transaction_id}',[PaymentController::class, 'show']);
    });
    
});
