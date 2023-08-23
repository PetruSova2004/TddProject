<?php

namespace App\Http\Middleware;

use App\Services\Response\ResponseService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DemandToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = DB::table('custom_tokens')->where('token', $request->header('guestToken'))->first();

        if ($token && $token->expires_at > now()) {
            return $next($request);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Failed to access this route, something is wrong with your token',
            ]);
        }
    }
}
