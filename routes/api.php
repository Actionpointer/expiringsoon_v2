<?php

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PlanResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\DealController;
use App\Http\Controllers\Guest\StoreController;
use App\Http\Controllers\Guest\AdvertController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guest\ProductController;
use App\Http\Controllers\Guest\ResourcesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
Route::get('states', [ResourcesController::class, 'states']);
Route::get('cities', [ResourcesController::class, 'cities']);
Route::get('location', [ResourcesController::class, 'location']);
Route::post('signup',[RegisterController::class,'register']);
Route::post('signin',[LoginController::class,'signIn']);
//password request and reset
Route::post('forgot-password',[ForgotPasswordController::class,'sendResetOtp']);
Route::post('reset-password',[ResetPasswordController::class,'verifyResetOtp']);                                        

Route::get('categories', [ResourcesController::class, 'categories']);
Route::get('attributes', [ResourcesController::class, 'attributes']);

Route::get('adverts',[AdvertController::class,'ads']);
Route::get('adverts/click/{advert_id}', [AdvertController::class, 'ad_click']);

Route::group(['prefix'=> 'products'],function (){
    Route::get('/',[ProductController::class,'index']);
    Route::get('{variant_id}',[ProductController::class,'show']);
    Route::get('{product_id}/reviews',[ProductController::class,'reviews']);
});

Route::group(['prefix'=> 'hotdeals'],function (){
    Route::get('pre-order',[DealController::class, 'preorder']);
    Route::get('bundles',[DealController::class, 'bundles']);
    Route::get('giveaway',[DealController::class, 'giveaway']);
    Route::get('coupons',[DealController::class, 'coupons']);
    Route::get('flash-sales',[DealController::class, 'flashsales']);
});
   
Route::group(['prefix'=> 'stores'],function (){
    Route::get('/', [StoreController::class, 'plans']);
    Route::get('{store_id}/shop', [StoreController::class, 'plans']);
    Route::get('{store_id}/coupons', [StoreController::class, 'plans']);
    Route::get('{store_id}/giveaways', [StoreController::class, 'plans']);
    Route::get('{store_id}/pre-order', [StoreController::class, 'plans']);  
});

Route::group(['prefix'=> 'blog'],function (){
    Route::get('/', [BlogController::class, 'index']);
    Route::get('{post_id}', [BlogController::class, 'show']);
    Route::post('{post_id}/like', [BlogController::class, 'like']);
});

Route::get('plans',function(){
    return PlanResource::collections(Plan::all());
});

Route::post('webhook',function(Request $request){
    Log::channel('single')->info(json_encode(['payload' => $request->all(),'headers' => $request->headers])); 
    return response()->json(200);
});
include_once('apicustomer.php');
include_once('apivendor.php');




