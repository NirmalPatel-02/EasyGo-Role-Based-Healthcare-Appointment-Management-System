<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'client') {
            return $next($request);
        }
    
        // Store the intended URL with query parameters
        session(['url.intended' => $request->fullUrl()]);
    
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        return redirect()->route('login')->withErrors(['error' => 'Access Denied']);
    }
    
    
}
