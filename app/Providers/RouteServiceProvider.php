<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    public const ORIENTATION = '/vendor/get-started';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('shop_id', function ($value) {
            return \App\Models\Shop::where('id', $value)->first();
        });
        Route::bind('product_id', function ($value) {
            return \App\Models\Product::where('id', $value)->first();
        });
        Route::bind('order_id', function ($value) {
            return \App\Models\Order::where('id', $value)->first();
        });
        Route::bind('state_id', function ($value) {
            return \App\Models\State::where('id', $value)->first();
        });
        Route::bind('advert_id', function ($value) {
            return \App\Models\Advert::where('id', $value)->first();
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::prefix('api/shopper')
                ->middleware('api')
                ->group(base_path('routes/apy.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
        
        RateLimiter::for('pin', function (Request $request) {
            return Limit::perMinutes(cache('settings')['throttle_security_time'],cache('settings')['throttle_security_attempt']);
        });
        
        RateLimiter::for('bvn', function (Request $request) {
            return Limit::perMinutes(cache('settings')['throttle_service_time'],cache('settings')['throttle_service_attempt']);
        });
    }
}
