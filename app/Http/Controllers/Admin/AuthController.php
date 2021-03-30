<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Defined\ApiResponse;

use App\Events\AdminLogin;

use App\Traits\Authenticatable;

class AuthController extends AdminController
{
    use Authenticatable;

    protected $guard = 'admin';

    public function login(Request $request)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $credentials = $request->only(['username', 'password']);
        $credentials['is_active'] = true;

        if (! $token = $this->guard()->attempt($credentials)) {
            $response['status'] = ApiResponse::UNAUTHORIZED;
        } else {
            event(new AdminLogin($token));
            $response['data'] = $this->respondWithToken($token);
        }

        return response($response);
    }
}
