<?php

namespace App\Http\Middleware;

use Closure;
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
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        $user = auth()->user();
        
        // Check if user works in any store
        if ($user->activeWorkplaces()->count() == 0) {
            return redirect()->route('dashboard')->with('error', 'You are not assigned to any store.');
        }
        
        // If store_id is provided, check if user works in that specific store
        if ($request->has('store_id') || $request->route('store_id')) {
            $storeId = $request->input('store_id') ?? $request->route('store_id');
            
            if (!$user->activeWorkplaces()->where('stores.id', $storeId)->exists()) {
                return redirect()->route('dashboard')->with('error', 'You do not have access to this store.');
            }
        }
        
        return $next($request);
    }
}
