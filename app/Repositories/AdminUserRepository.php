<?php

namespace App\Repositories;

use App\Models\AdminUser;

class AdminUserRepository extends Repository
{
    protected static $model = AdminUser::class;

    public static function allUsers()
    {
        // return static::$model::all()
        //     ->map(function ($user) {
                
        //     });
    }
}
