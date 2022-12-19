<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('get-started', [App\Http\Controllers\ApiControllers\AuthController::class, 'index']);
Route::post('re-issue-token', [App\Http\Controllers\ApiControllers\AuthController::class, 'issue_token']);
Route::post('access-pin', [App\Http\Controllers\ApiControllers\AuthController::class, 'access_pin']);
Route::get('plans', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'plans']);
Route::get('states', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'states']);
Route::get('cities/{state_id}', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'cities']);
Route::get('categories', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'categories']);
Route::get('tags/{category_id}', [App\Http\Controllers\ApiControllers\ResourcesController::class, 'tags']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::resource('shops','App\Http\Controllers\ApiControllers\ShopController');
    Route::get('shop/{shop_id}/products',[App\Http\Controllers\ApiControllers\ProductController::class,'index']);
    Route::resource('products','App\Http\Controllers\ApiControllers\ProductController');
    Route::resource('subscriptions','App\Http\Controllers\ApiControllers\SubscriptionController');

});
