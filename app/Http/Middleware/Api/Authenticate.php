<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Defined\ApiResponse;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = preg_split('/ /', $request->header('Authorization'))[1] ?? null;

        try {
            if (is_null($token)) {
                $response = response(['status' => ApiResponse::UNAUTHORIZED]);
            } elseif (!auth()->payload()) {
                $response = response(['status' => ApiResponse::UNAUTHORIZED]);
            } else {
                $response = $next($request);
            }
        } catch (TokenInvalidException $ex) {
            $response = response(['status' => ApiResponse::TOKEN_INVALID]);
        } catch (TokenExpiredException $ex) {
            $response = response(['status' => ApiResponse::TOKEN_EXPIRED]);
        }

        return $response;
    }
}
