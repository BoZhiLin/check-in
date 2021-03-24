<?php

namespace App\Services;

use App\Defined\LeaveType;
use App\Defined\ApiResponse;

use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;

use App\Tools\Tool;

class UserService
{
    public static function getInfo(int $user_id)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $user = UserRepository::findByPrimary($user_id);

        if (is_null($user)) {
            $response['status'] = ApiResponse::USER_NOT_FOUND;
        } else {
            $special_leave_wallet = WalletRepository::getByUser($user_id, LeaveType::SPECIAL);
            $recoup_leave_wallet = WalletRepository::getByUser($user_id, LeaveType::RECOUP);

            $user_info = [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'gender' => $user->gender,
                'phone' => $user->phone,
                'report_date' => $user->report_date,
                'special_leave_amount' => Tool::secondsToTime($special_leave_wallet->balance_available),
                'recoup_leave_amount' => Tool::secondsToTime($recoup_leave_wallet->balance_available),
                'remark' => $user->remark
            ];

            $response['data']['user'] = $user_info;
        }

        return $response;
    }
}
