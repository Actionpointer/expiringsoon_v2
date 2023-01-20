<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\Vendor\ProductController;
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
Route::webhooks('webhooks-test');

Route::post('webhook',function(Request $request){
    logger()->info([
        'payload' => $request->all(),
        'headers' => $request->headers,
    ]);
    return response()->json(200);

})->name('test.webhook');

Route::post('register', [ApiController::class, 'register']);
Route::post('login/vendor', [ApiController::class, 'login_vendor']);
Route::post('login/shopper', [ApiController::class, 'login_shopper']);


// Route::post('register' ,[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('register');
// Route::post('email/resend',[App\Http\Controllers\Auth\VerificationController::class,'resend'])->name('verification.resend');                                                
// Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
// Route::post('logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
// Route::post('password/email',[App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');                    
// Route::post('password/reset',[App\Http\Controllers\Auth\ResetPasswordController::class,'reset'])->name('password.update');                  

Route::get('plans', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'plans']);
Route::get('states', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'states']);
Route::get('cities/{state_id}', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'cities']);
Route::get('categories', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'categories']);
Route::get('tags/{category_id}', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'tags']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    return new UserResource(User::findOrFail($request->user()->id));
});
Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::get('generate-otp',[UserController::class, 'generate_otp']);
        Route::post('pin', [UserController::class, 'pin']);
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
    });

    Route::group(['prefix'=> 'shops'],function(){
        Route::get('/',[ShopController::class,'index']);
        Route::get('{shop_id}',[ShopController::class,'details']);
        Route::post('store',[ShopController::class,'store']);
        Route::post('import',[ShopController::class,'import']);
        Route::post('update',[ShopController::class,'update']);
        Route::post('delete',[ShopController::class,'destroy']);
        Route::get('{shop_id}/products',[ProductController::class,'list']);
        Route::get('{shop_id}/products/{product_id}',[ProductController::class,'details']);
        Route::post('products/store',[ProductController::class,'store']);
        Route::post('products/update',[ProductController::class,'update']);
        Route::post('products/delete',[ProductController::class,'destroy']);
        Route::group(['prefix'=>'shipping/rates'],function (){
            Route::get('/{shop_id}',[App\Http\Controllers\ApiControllers\ShopController::class,'shipping_index']);
            Route::post('store',[App\Http\Controllers\ApiControllers\ShopController::class,'shipping_store']);
            Route::post('update',[App\Http\Controllers\ApiControllers\ShopController::class,'shipping_update']);
            Route::post('delete',[App\Http\Controllers\ApiControllers\ShopController::class,'shipping_delete']);
        });
    });
    
    

    

    Route::group(['prefix'=>'subscription'],function (){
        Route::get('plans',[SubscriptionController::class,'plans']);
        Route::post('store',[SubscriptionController::class,'store']);
        Route::post('cancel_renewal',[SubscriptionController::class,'cancel_renewal']);
        
    });
});
