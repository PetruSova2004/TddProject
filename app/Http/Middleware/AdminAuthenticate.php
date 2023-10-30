<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(Auth::user()->getAuthIdentifier());
        if ($user->is_admin) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'No');
        }
    }
}
