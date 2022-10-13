<?php

namespace App\Providers;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        
        
        $settings = Cache::rememberForever('settings', function () {
            return \App\Models\Setting::select(['name','value'])->get()->pluck('value','name')->toArray();
        });
        if(!session('geo_locale')){
            $ip = request()->ip() == '::1'|| request()->ip() == '127.0.0.1'? '197.211.58.12' : request()->ip();
            $result = Curl::to('http://www.geoplugin.net/php.gp?ip='.$ip)->get();
            $location =  unserialize($result);
            if($location && $location['geoplugin_region'])
                session(['geo_locale' => ['country_name'=>$location['geoplugin_countryName'],'country_code'=> $location['geoplugin_countryCode'],'state'=> $location['geoplugin_region']] ]);
            else session(['geo_locale' => ['country_name'=> cache('settings')['country'],'country_code'=> cache('settings')['country_iso'],'state'=> 'lagos'] ]);
            
        }
            
        
        
        
    }
}
