<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //public function handle(Request $request, Closure $next): Response
   // {
    //    return $next($request);
   // }
 
    public function handle(Request $request, Closure $next, $userType)
    {
        $user = auth()->user();
        
        // If user is provider, redirect to home
        if ($user->type === 'provider') {
            return redirect()->route('home');
        }
        
        // Check if user has the required role
        if ($user->type === $userType) {
            return $next($request);
        }
 
        // If user is not authorized, redirect to home with error message
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}