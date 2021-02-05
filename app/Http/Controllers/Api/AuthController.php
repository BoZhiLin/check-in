<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Defined\ApiResponse;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $credentials = $request->only(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            $response['status'] = ApiResponse::UNAUTHORIZED;
        } else {
            $response['data'] = $this->respondWithToken($token);
        }

        return response($response);
    }

    public function logout()
    {
        auth()->logout();
        return response(['status' => ApiResponse::SUCCESS]);
    }

    public function refresh()
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $token_info = $this->respondWithToken(auth()->refresh());
        $response['data'] = $token_info;

        return response($response);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expired_at' => strtotime(now()->addMinutes(config('jwt.ttl')))
        ];
    }
}
