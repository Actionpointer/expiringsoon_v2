<?php

use App\Livewire\Auth\Signin;
use App\Livewire\Auth\Signup;
use App\Livewire\Guest\Welcome;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Guest\Blog\BlogList;
use Illuminate\Support\Facades\Route;
use App\Livewire\Guest\Blog\BlogArticle;
use App\Http\Controllers\PaymentController;

Route::get('/', Welcome::class)->name('welcome');
Route::middleware('guest')->group(function(){
    Route::get('signin', Signin::class)->name('signin');
    Route::get('signup', Signup::class)->name('signup');
    Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
    Route::get('reset-password', ResetPassword::class)->name('reset-password');
});


Route::view('products', 'guest.products')->name('products');
Route::view('products/{product}', 'guest.product')->name('product');
Route::view('hotdeals', 'guest.hotdeals')->name('hotdeals');
Route::view('stores', 'guest.stores')->name('stores');
Route::view('stores/{store}', 'guest.store')->name('store');
Route::view('cart', 'guest.cart')->name('cart');
Route::view('compare', 'guest.compare')->name('compare');
Route::get('blog', BlogList::class)->name('blog');
Route::get('blog-single', BlogArticle::class)->name('blog-single');


Route::group(['middleware'=>'auth'],function(){
    Route::get('home',function(){
        if(auth()->user()->is_admin){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('dashboard');
        }
    });
    Route::get('payment/callback',[PaymentController::class,'paymentcallback'])->name('payment.callback');
    include('customer.php');
    include('store.php');
});



Route::group(['prefix' => 'store-filemanager/', 'middleware' => ['web','vendor']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['web','signed'])->get('filemanager', function () {
    session(['store_slug' => request()->store_slug]);
    return redirect('/store-filemanager');
})->name('unisharp.filemanager');









