<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookie = Cookie::get('Token');
        if ($cookie) {
            return $next($request);
        } else {
            return redirect()->route('home')->with('error', 'You need to log in to access this page');
        }
    }
}
