<?php

namespace App\Services;

use App\Defined\ApiResponse;

use App\Models\User;

class UserService
{
    public static function getInfo(int $user_id)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $user = User::find($user_id);

        if (is_null($user)) {
            $response['status'] = ApiResponse::USER_NOT_FOUND;
        } else {
            $user_info = [
                'id' => $user->id,
                'name' => $user->name,
                'gender' => $user->gender,
                'phone' => $user->phone,
                'report_date' => $user->report_date
            ];

            $response['data']['user'] = $user_info;
        }

        return $response;
    }
}
