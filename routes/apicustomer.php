<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\VendorResource;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Customer\SalesController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ShipmentController;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;


Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::get('/',function(){
            return new CustomerResource(User::findOrFail(request()->user()->id));
        });
        Route::group(['prefix'=> 'otp','as'=> 'otp.','middleware'=> ['auth']],function(){
            Route::get('/',[HomeController::class, 'otp_request']);
            Route::get('resend',[HomeController::class,'otp_resend']);
            Route::post('verify',[HomeController::class,'otp_verify']);;
            Route::get('generate/otp',[UserController::class, 'generate_otp']);
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
        

        Route::group(['prefix'=>'address'],function(){
            Route::get('/', [AddressController::class, 'index']);
            Route::post('store', [AddressController::class, 'update']);
            Route::post('update', [AddressController::class, 'update']);
            Route::post('destroy', [AddressController::class, 'destroy']); 
        });
        
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);

        Route::group(['prefix'=> 'followers'],function(){
            Route::get('/', [SalesController::class, 'index']);
            Route::post('follow', [SalesController::class, 'store']);
            Route::post('unfollow', [SalesController::class, 'update']);
        });

        Route::get('notifications',[UserController::class,'notifications']);
        Route::get('updates',[UserController::class,'notifications']);
        Route::post('notifications/read',[UserController::class,'readNotifications']);
    
        Route::post('payment/status',[App\Http\Controllers\PaymentController::class,'paymentcallback']);
        
    });
    //email verification
    Route::post('email/resend',[VerificationController::class,'resend']);                                            
    Route::post('email/verify',[VerificationController::class,'verify']);    
    //password confirmation
    Route::post('password/confirm',[ConfirmPasswordController::class,'confirm']);
    
    Route::post('logout',[LoginController::class,'logout']);

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
