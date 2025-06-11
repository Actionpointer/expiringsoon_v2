<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->has('store') && !$request->route('store') && !$request->route('store_slug') && !session('store_slug')){
            return response()->json([
                'status' => false,
                'message' => 'Store not found.',
            ], 404);
        }
        if($request->route('store_slug')){
            session(['store_slug' => $request->route('store')]);
        }
        return $next($request);
    }
}
