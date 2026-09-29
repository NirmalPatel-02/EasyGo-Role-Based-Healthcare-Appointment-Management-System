<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DoctorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'doctor') {
            return $next($request);
        }

        // Determine if the request is from API or Web
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Keep the intended page tied to the role that is allowed to open it.
        session([
            'url.intended' => $request->fullUrl(),
            'url.intended_role' => 'doctor',
        ]);

        return redirect()->route('login')->withErrors(['error' => 'Access Denied']);
    }
}
