<?php

namespace App\Services;

use App\Defined\ApiResponse;
use App\Defined\LeaveStatus;

use App\Models\Leave;
use App\Models\Check;

class LeaveService
{
    /**
     * 請假，需給主管or後台審核
     * 
     * @param int $user_id
     * @param string $date
     * @param string $type
     * @param string $started_time
     * @param string $ended_time
     * @return array
     */
    public static function reply(int $user_id, string $date, string $type, string $started_time, string $ended_time)
    {
        $response = ['status' => ApiResponse::SUCCESS];

        $leave = new Leave();
        $leave->user_id = $user_id;
        $leave->date = $date;
        $leave->type = $type;
        $leave->started_time = $started_time;
        $leave->ended_time = $ended_time;
        $leave->status = LeaveStatus::PROGRESSING;

        $leave->save();

        return $response;
    }

    /**
     * 請假紀錄
     * 
     * @param int $user_id
     * @param string $date
     * @return array
     */
    public static function getUserRecords(int $user_id, string $date = null)
    {
        $response = ['status' => ApiResponse::SUCCESS];

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

        return $response;
    }
}
