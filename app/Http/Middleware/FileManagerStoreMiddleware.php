<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileManagerStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get store_id from session and add it to the request
        if (session()->has('store_id')) {
            $request->merge(['store_id' => session('store_id')]);
        }
        
        return $next($request);
    }
} 