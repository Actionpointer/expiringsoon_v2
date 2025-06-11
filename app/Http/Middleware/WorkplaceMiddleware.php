<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Store;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkplaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = auth()->user();
        
        // Check if user works in any store
        if ($user->activeWorkplaces()->count() == 0) {
            return response()->json([
                'status' => false,
                'message' => 'You are not assigned to any store.',
            ], 403);
        }
        
        // If store_id is provided, check if user works in that specific store
        if ($request->has('store_id') || $request->route('store_id') || $request->route('store')) {
            if($request->route('store_slug')){
                $store = Store::where('slug', $request->route('store_slug'))->first();
                $storeId = $store->id;
            }else{
                $storeId = $request->input('store_id') ?? $request->route('store_id')->id;
            }
            
            if (!$user->activeWorkplaces()->where('stores.id', $storeId)->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have access to this store.',
                ], 403);
            }
        }
        
        return $next($request);
    }
}
