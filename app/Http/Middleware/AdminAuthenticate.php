<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        // esem - encrypted secret email
        $user = User::query()->where('email', Cookie::get('esem'))->first();
        if ($user->is_admin === 'Yes') {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'You dont have admin privileges');
        }
    }
}
