<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\VendorResource;
use App\Http\Controllers\UserController;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Guest\AdvertController;
use App\Http\Controllers\Vendor\AdsetController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StaffController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shopper\SalesController;
use App\Http\Controllers\Shopper\ReviewController;
use App\Http\Controllers\Vendor\FeatureController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Shopper\AddressController;
use App\Http\Controllers\Vendor\ShipmentController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Vendor\SubscriptionController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
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

Route::get('countries',[ResourcesController::class,'countries']);
Route::get('states/{country_id?}', [ResourcesController::class, 'states']);
Route::get('cities/{state_id?}', [ResourcesController::class, 'cities']);
Route::get('location', [ResourcesController::class, 'location']);

Route::post('webhook',function(Request $request){
    Log::channel('single')->info(json_encode(['payload' => $request->all(),'headers' => $request->headers])); 
    return response()->json(200);
});

Route::post('signup',[RegisterController::class,'register']);
Route::post('signin',[LoginController::class,'signIn']);
//password request and reset
Route::post('password/email',[ForgotPasswordController::class,'sendResetLinkEmail']);
Route::post('password/reset',[ResetPasswordController::class,'reset']);                                        

Route::get('plans', [SubscriptionController::class, 'plans']);

Route::get('categories', [ResourcesController::class, 'categories']);
Route::get('tags/{category_id}', [ResourcesController::class, 'tags']);
Route::get('products',[ProductController::class,'index']);
Route::get('product/{product_id}',[ProductController::class,'show']);
Route::get('hotdeals',[ProductController::class, 'hotdeals']);
Route::get('vendors',[ShopController::class, 'index']);
Route::get('vendor/{shop_id}',[ShopController::class, 'show']);

Route::get('reviews/{product_id}',[ReviewController::class,'reviews']);


 Route::get('adverts',[AdvertController::class,'ads']);

Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::get('/',function(Request $request){
            return new CustomerResource(User::findOrFail($request->user()->id));
        });
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
        Route::get('following',[UserController::class, 'followings']);
    });
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    
    //email verification
    Route::post('email/resend',[VerificationController::class,'resend']);                                            
    Route::post('email/verify',[VerificationController::class,'verify']);    
    //password confirmation
    Route::post('password/confirm',[ConfirmPasswordController::class,'confirm']);

    Route::get('/user', function (Request $request) {
        return new VendorResource(User::findOrFail($request->user()->id));
    });
    Route::get('notifications',[UserController::class,'notifications']);
    Route::post('notifications/read',[UserController::class,'readNotifications']);
    Route::post('applycoupon',[ResourcesController::class, 'coupon'])->name('applycoupon');

    Route::get('vendor/follow/{shop_id}',[SalesController::class, 'follow']);
    Route::get('vendor/unfollow/{shop_id}',[SalesController::class, 'unfollow']);
    Route::get('wishlist', [SalesController::class, 'wishlist']);
    Route::post('wishlist/add',[CartController::class,'addtowish']);
    Route::post('wishlist/remove',[CartController::class,'removefromwish']);

    Route::get('cart', [CartController::class, 'cart']);
    Route::post('cart/add',[CartController::class,'addtocart']);
    Route::post('cart/remove',[CartController::class,'removefromcart']);
    
    Route::get('addresses', [AddressController::class,'index']);
    Route::post('address/store',[AddressController::class,'store']);
    Route::post('address/update',[AddressController::class,'update']);
    Route::post('address/delete',[AddressController::class,'destroy']);

    Route::post('checkout',[SalesController::class,'checkout_api']);
    Route::post('checkout/confirm',[SalesController::class,'confirmcheckout_api']);

    Route::get('orders/{status?}', [OrderController::class, 'index']);
    Route::get('order/{order_id}',[OrderController::class, 'show']);
    Route::post('order/update',[OrderController::class, 'update']); 
    Route::get('orders/{order_id}/messages',[OrderController::class,'messages']);
    Route::post('order/message',[OrderController::class, 'message']);
    Route::post('order/review',[ReviewController::class, 'review']);


    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('/',[PaymentController::class, 'index']);    
    });

    Route::get('generate/otp',[UserController::class, 'generate_otp']);
    Route::post('edit-pin',[UserController::class, 'pin']);
    
   
    Route::get('advert/{advert_id}', [AdvertController::class, 'ad_click']);

    Route::get('featured', [AdvertController::class, 'featured']);
    Route::get('featured/{feature_id}', [AdvertController::class, 'featured_click']);

    
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
