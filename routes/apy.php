<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApyController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\Vendor\PaymentController;
use App\Http\Controllers\Auth\VerificationController;

use App\Http\Resources\CustomerResource;

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

Route::post('email/resend',[VerificationController::class,'resend']);                                              
Route::post('email/verify',[VerificationController::class,'verify']);                                                

Route::post('password/email',[App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');                    
Route::post('password/reset',[App\Http\Controllers\Auth\ResetPasswordController::class,'reset'])->name('password.update');                  

Route::get('states', [ResourcesController::class, 'states']);
Route::get('cities/{state_id}', [ResourcesController::class, 'cities']);
Route::get('categories', [ResourcesController::class, 'categories']);
Route::get('tags/{category_id}', [ResourcesController::class, 'tags']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    return new CustomerResource(User::findOrFail($request->user()->id));
});
Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::group(['prefix'=> 'user'],function(){
        Route::post('profile', [UserController::class, 'update']);
        Route::post('password', [UserController::class, 'password']);
    });
    Route::group(['prefix'=> 'transactions'],function(){
        Route::get('transactions',[PaymentController::class, 'index']);
        
    });

    
});
