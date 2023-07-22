<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class DeleteCartIfUnauthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookie = Cookie::get('Token');
        $userEmail = Cookie::get('User');
        $user = User::query()->where('email', $userEmail)->first();

        if (!$user) {
            return $next($request);
        }

        if (!$cookie) {
            Cart::query()->where('user_id', $user->id)->delete();
        }

        return $next($request);
    }
}
