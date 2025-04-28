<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportedCountryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()){
            $user = $request->user();
            if(!$user->country->supported){
                return $request->expectsJson()
                ? response()->json(['status'=> false,'message' => 'Country is not supported'], 403)
                : \abort(403);
            }
        }
        return $next($request);
    }
}
