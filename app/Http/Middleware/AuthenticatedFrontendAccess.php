<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedFrontendAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       

        // Check if the user is authenticated and trying to access a restricted route
        if (Auth::check() && Auth::user()->hasRole('farmer')) {
            // User is authenticated, allow access to the page
            return $next($request);
        }

        // If the user is not authorized, you can redirect or show an error page
        return redirect()->route('frontend.home');
    }
}
