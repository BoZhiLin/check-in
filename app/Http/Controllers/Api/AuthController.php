<?php

namespace App\Http\Controllers\Api;

use App\Traits\Authenticatable;

class AuthController extends ApiController
{
    use Authenticatable;

    protected $guard = 'api';
}
