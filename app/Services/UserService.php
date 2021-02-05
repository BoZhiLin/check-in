<?php

namespace App\Services;

use App\Defined\ApiResponse;

use App\Models\User;

class UserService
{
    public static function getByUserName(string $username = null)
    {
        return User::where('username', $username)->first();
    }
}
