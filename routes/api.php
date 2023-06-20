<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\VendorResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ShipmentController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Vendor\SubscriptionController;

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

Route::post('webhook',function(Request $request){
    logger()->info([
        'payload' => $request->all(),
        'headers' => $request->headers,
    ]);
    return response()->json(200);
});


Route::post('register', [ApiController::class, 'register']);
Route::post('login/vendor', [ApiController::class, 'login']);
Route::post('email/resend',[VerificationController::class,'resend']);                                            
Route::post('email/verify',[VerificationController::class,'verify']);                                                
Route::post('password/email',[App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail']);                    
Route::post('password/reset',[App\Http\Controllers\Auth\ResetPasswordController::class,'reset']);                  

Route::get('plans', [SubscriptionController::class, 'plans']);
Route::get('location', [ResourcesController::class, 'location']);
Route::get('states/{country_id?}', [ResourcesController::class, 'states']);
Route::get('cities/{state_id}', [ResourcesController::class, 'cities']);
Route::get('categories', [ResourcesController::class, 'categories']);
Route::get('tags/{category_id}', [ResourcesController::class, 'tags']);



Route::group(['middleware'=> 'auth:sanctum'],function(){
    Route::get('/user', function (Request $request) {
        return new VendorResource(User::findOrFail($request->user()->id));
    });
    Route::get('notifications',[UserController::class,'notifications']);
    Route::post('notifications/read',[UserController::class,'readNotifications']);
    Route::post('applycoupon',[ResourcesController::class, 'coupon'])->name('applycoupon');
});

Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
    });

    Route::group(['prefix'=> 'vendor'],function(){
        Route::get('transactions',[PaymentController::class, 'index']);
        Route::get('generate-otp',[UserController::class, 'generate_otp']);
        Route::post('pin', [UserController::class, 'pin']);
        Route::post('kyc',[StaffController::class,'kyc']);
    });

    Route::group(['prefix'=> 'shops'],function(){
        Route::get('/',[ShopController::class,'index']);
        Route::get('{shop_id}',[ShopController::class,'show']);
        Route::post('store',[ShopController::class,'store']);
        Route::post('import',[ShopController::class,'import']);
        Route::post('update',[ShopController::class,'update']);
        Route::post('delete',[ShopController::class,'destroy']);
        // Route::get('{shop_id}/staff',[StaffController::class,'index']);
        Route::get('{shop_id}/products',[ProductController::class,'index']);
        Route::get('{shop_id}/products/{product_id}',[ProductController::class,'details']);
        Route::post('products/store',[ProductController::class,'store']);
        Route::post('products/update',[ProductController::class,'update']);
        Route::post('products/delete',[ProductController::class,'destroy']);
        

        Route::get('/{shop_id}/package/rates',[ShipmentController::class,'packages']);
        Route::post('package/rates/manage',[ShipmentController::class,'packages_manage']);
        
        Route::get('/{shop_id}/shipping/rates',[ShipmentController::class,'index']);
        Route::group(['prefix'=>'shipping/rates'],function (){
            Route::post('store',[ShipmentController::class,'store']);
            Route::post('update',[ShipmentController::class,'update']);
            Route::post('delete',[ShipmentController::class,'delete']);
        });

        Route::get('{shop_id}/orders/{status?}',[OrderController::class,'index']);
        Route::get('orders/view/{order_id}',[OrderController::class,'show']);
        Route::post('orders/update',[OrderController::class,'update']);
        Route::get('{shop_id}/orders/{order_id}/messages',[OrderController::class,'messages']);
        Route::post('orders/message',[OrderController::class,'message']);

        Route::group(['prefix'=>'{shop_id}'],function (){
            Route::get('notifications',[ShopController::class,'notifications']);
            Route::get('earnings',[PaymentController::class,'earnings']);
            Route::get('payouts',[PaymentController::class,'payouts']);
            Route::post('payout',[PaymentController::class,'payout']);
        });
        
    });

    Route::group(['prefix'=>'subscription'],function (){
        Route::get('plans',[SubscriptionController::class,'plans']);
        Route::post('store',[SubscriptionController::class,'subscribe']);
        Route::post('cancel_renewal',[SubscriptionController::class,'cancel_renewal']);
    });

    Route::group(['prefix'=>'adsets'],function(){
        Route::get('/',[AdsetController::class,'index']);
        Route::get('plans',[AdsetController::class,'plans']);
        Route::post('subscribe',[AdsetController::class,'store']);
        Route::post('cancel_renewal',[AdsetController::class,'cancel_renewal']);
        
        Route::post('ads/filter',[FeatureController::class,'filter_products']);
        Route::post('ads/store',[FeatureController::class,'store']);
        Route::post('ads/delete',[FeatureController::class,'remove']);

    });

    Route::post('payment/status',[App\Http\Controllers\PaymentController::class,'paymentcallback']);
    
    
});
