<?php

namespace App\Providers;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);  
        // $settings = Cache::rememberForever('settings', function () {
        //     return \App\Models\Setting::select(['name','value'])->get()->pluck('value','name')->toArray();
        // });      
    }
}
