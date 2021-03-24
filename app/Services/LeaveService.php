<?php

namespace App\Services;

use App\Defined\LeaveType;
use App\Defined\ApiResponse;
use App\Defined\LeaveStatus;
use App\Defined\TransactionType;

use App\Repositories\LeaveRepository;
use App\Repositories\WalletRepository;
use App\Repositories\TransactionRepository;

use App\Tools\Tool;

class LeaveService
{
    /**
     * 請假，需給後台審核
     * 
     * @param int $user_id
     * @param string $date
     * @param string $type
     * @param string $started_time
     * @param string $ended_time
     * @return array
     */
    public static function apply(int $user_id, string $date, string $type, string $started_time, string $ended_time)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $total_seconds = Tool::duration($ended_time, $started_time);

        if ($type === LeaveType::SPECIAL || $type === LeaveType::RECOUP) {
            $wallet = WalletRepository::getByUser($user_id, $type);
        }

        if (isset($wallet)) {
            if ($wallet->balance_available < $total_seconds) {
                $response['status'] = ApiResponse::LEAVE_TIMES_NOT_ENOUGH;
            } else {
                TransactionRepository::createByWallet($wallet, TransactionType::LEAVE_REPLY, $total_seconds);
            }
        }

        if ($response['status'] === ApiResponse::SUCCESS) {
            $leave_info = LeaveRepository::create([
                'user_id' => $user_id,
                'date' => $date,
                'type' => $type,
                'started_time' => $started_time,
                'ended_time' => $ended_time,
                'duration' => $total_seconds,
                'status' => LeaveStatus::PROGRESSING
            ]);

            $response['data']['leave'] = $leave_info;
        }

        return $response;
    }

    /**
     * 請假紀錄
     * 
     * @param int $user_id
     * @param string $date
     * @return array
     */
    public static function getUserRecords(int $user_id)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $user_leaves = LeaveRepository::getByUser($user_id, 'desc');
        $response['data']['records'] = $user_leaves;

        return $response;
    }

    /**
     * 請假審核
     * 
     * @param int $leave_id
     * @param string $status
     * @return array
     */
    public static function verify(int $leave_id, string $status)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $leave = LeaveRepository::findByPrimary($leave_id);

        if (is_null($leave)) {
            $response['status'] = ApiResponse::LEAVE_NOT_FOUND;
        } else {
            if ($status === LeaveStatus::REJECT) {
                if ($leave->type === LeaveType::SPECIAL || $leave->type === LeaveType::RECOUP) {
                    $wallet = WalletRepository::getByUser($leave->user_id, $leave->type);
                    TransactionRepository::createByWallet(
                        $wallet,
                        TransactionType::RETURN_BALANCE,
                        $leave->duration
                    );
                }
            }

            $leave->status = $status;
            $leave->save();
        }

        return $response;
    }
}
