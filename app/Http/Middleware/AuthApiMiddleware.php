<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Response;

class AuthApiMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->auth->parseToken()->authenticate();
            if (Auth::guard('api')->check()) {
                return $next($request);
            }

            return response()->json(['error' => 'トークンは許可されていません'], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['error' => 'トークンが正しくありません'], Response::HTTP_UNAUTHORIZED);
            }
            if ($e instanceof TokenExpiredException) {
                return response()->json(['error' => '期限切れのトークン'], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json(['error' => 'トークンは許可されていません'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
