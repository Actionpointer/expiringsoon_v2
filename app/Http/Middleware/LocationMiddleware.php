<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Location;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\View;
use App\Http\Traits\GeoLocationTrait;

class LocationMiddleware
{
    use GeoLocationTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session('locale')){
            $ip = request()->ip() == '::1'|| request()->ip() == '127.0.0.1'? '197.211.58.12' : request()->ip();
            //check location table first
            if($location = $this->getLocation($ip)){
                session(['locale'=> $this->getLocale($location)]);
            }else{
                //check outside
                $result = Curl::to('http://www.geoplugin.net/php.gp?ip='.$ip)->get();
                $geo_location =  unserialize($result);
                if($geo_location && $geo_location['geoplugin_countryCode']){
                    //save location
                    $location = $this->saveLocation($geo_location);
                    //store session
                    session(['locale'=> $this->getLocale($location)]);
                }else{
                    //store fake place in session
                    $ip = '197.211.58.12';
                    $location = $this->getLocation($ip);
                    session(['locale'=> $this->getLocale($location)]);
                }  
                
            }
        }

            
            
            
        return $next($request);
    }
}
