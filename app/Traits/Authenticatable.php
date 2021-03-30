<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Defined\ApiResponse;

trait Authenticatable
{
    public function login(Request $request)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $credentials = $request->only(['username', 'password']);

        if (! $token = $this->guard()->attempt($credentials)) {
            $response['status'] = ApiResponse::UNAUTHORIZED;
        } else {
            $response['data'] = $this->respondWithToken($token);
        }

        return response($response);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response(['status' => ApiResponse::SUCCESS]);
    }

    public function refresh()
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $token_info = $this->respondWithToken($this->guard()->refresh());
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

    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
