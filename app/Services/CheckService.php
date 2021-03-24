<?php

namespace App\Services;

use App\Defined\System;
use App\Defined\ApiResponse;

use App\Models\Check;

use App\Tools\Tool;

class CheckService
{
    /**
     * 當天簽到
     * 
     * @param int $user_id
     * @param string $time (hh:mm:ss)
     * @return array
     */
    public static function checkIn(int $user_id, string $time)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $work_on_time = System::NORMAL_WORK_TIME;
        $today_record = Check::where('user_id', $user_id)
            ->whereDate('date', today())
            ->first();

        if (!is_null($today_record)) {
            $response['status'] = ApiResponse::CHECK_IN_EXISTS;
        } elseif (strtotime($time) < strtotime($work_on_time)) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_OPEN;
        } elseif (strtotime('now') < strtotime($work_on_time)) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_OPEN;
        } else {
            $record = new Check();
            $record->user_id = $user_id;
            $record->started_time = $time;

            $record->save();
        }

        return $response;
    }

    /**
     * 當天簽退
     * 
     * @param int $user_id
     * @return array
     */
    public static function checkOut(int $user_id, string $time)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $today_record = Check::where('user_id', $user_id)
            ->whereDate('date', today())
            ->first();

        if (is_null($today_record)) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_FOUND;
        } elseif (!is_null($today_record->ended_time)) {
            $response['status'] = ApiResponse::CHECK_OUT_EXISTS;
        } else {
            $duration = $today_record->started_time ?
                Tool::duration(
                    $time, 
                    $today_record->started_time
                ) : 0;

            $today_record->duration = $duration;
            $today_record->ended_time = $time;
            $today_record->save();
        }

        return $response;
    }

    /**
     * 取得使用者打卡紀錄 (依照日期，若為空則預設當日)
     * 
     * @param int $user_id
     * @param string $date
     * @return array
     */
    public static function getUserRecords(int $user_id, string $date = null)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $date = $date ?? today();

        $response['data']['record'] = Check::where('user_id', $user_id)
            ->whereDate('date', $date)
            ->first();

        return $response;
    }
}
