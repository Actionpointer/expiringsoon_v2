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
        //178.238.11.6 || 197.211.58.12
        $ip = request()->ip() == '::1'|| request()->ip() == '127.0.0.1'? '197.211.58.12' : request()->ip();
        if(!cache('visitors') || cache('visitors') == null || cache('visitors') == [] || !in_array($ip,cache('visitors'))){
            $result = Curl::to("https://api.ipdata.co/".$ip."?api-key=".config('services.ipdata'))->asJsonResponse()->get();
            if($result){
                $this->saveCountry($result);
                $visitors[] = $ip;
                cache(['visitors'=> $visitors]);       
            }
        }
        return $next($request);
    }
}
