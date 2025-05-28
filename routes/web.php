<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::view('products', 'guest.products')->name('products');
Route::view('products/{product}', 'guest.product')->name('product');
Route::view('hotdeals', 'guest.hotdeals')->name('hotdeals');
Route::view('stores', 'guest.stores')->name('stores');
Route::view('stores/{store}', 'guest.store')->name('store');
Route::view('cart', 'guest.cart')->name('cart');
Route::view('compare', 'guest.compare')->name('compare');
Route::view('blog', 'guest.blog')->name('blog');
Route::view('blog-single', 'guest.blog-single')->name('blog-single');


//store



// Route::group(['middleware'=>'auth'],function(){
    include('customer.php');
    include('store.php');
// });



Route::group(['prefix' => 'store-filemanager/', 'middleware' => ['web','vendor']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['web','signed'])->get('filemanager', function () {
    session(['store_slug' => request()->store_slug]);
    return redirect('/store-filemanager');
})->name('unisharp.filemanager');








