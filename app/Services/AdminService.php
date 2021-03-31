<?php

namespace App\Services;

use App\Defined\ApiResponse;

use App\Repositories\AdminUserRepository;

class AdminService
{
    public static function getAdminUsers()
    {
        $response = ['status' => ApiResponse::SUCCESS];
    }
}
