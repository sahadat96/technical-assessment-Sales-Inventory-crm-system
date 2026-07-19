<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 401);
            }
        } catch (JWTException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Token is invalid or missing.',
            ], 401);
        }

        return $next($request);
    }
}
