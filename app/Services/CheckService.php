<?php

namespace App\Services;

use App\Defined\System;
use App\Defined\ApiResponse;

use App\Models\Check;

use App\Repositories\CheckRepository;

use App\Tools\Tool;

class CheckService
{
    /**
     * 當天簽到
     * 
     * @param int $user_id
     * @param string $started_time (hh:mm:ss)
     * @return array
     */
    public static function checkIn(int $user_id, string $started_time)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $work_on_time = System::NORMAL_WORK_TIME;
        $today_record = CheckRepository::getUserRecordByDate($user_id, date('Y-m-d'));

        if (!is_null($today_record)) {
            $response['status'] = ApiResponse::CHECK_IN_EXISTS;
        } elseif (strtotime($started_time) < strtotime($work_on_time)) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_OPEN;
        } elseif (strtotime('now') < strtotime($work_on_time)) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_OPEN;
        } else {
            $check_info = CheckRepository::create([
                'user_id' => $user_id,
                'date' => today(),
                'started_time' => $started_time
            ]);
            
            $response['data']['check'] = $check_info;
        }

        return $response;
    }

    /**
     * 當天簽退
     * 
     * @param int $user_id
     * @param string $ended_time
     * @return array
     */
    public static function checkOut(int $user_id, string $ended_time)
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
                    $ended_time, 
                    $today_record->started_time
                ) : 0;

            $today_record->duration = $duration;
            $today_record->ended_time = $ended_time;
            $today_record->save();
        }

        return $response;
    }

    /**
     * 取得使用者打卡紀錄
     * 
     * @param int $user_id
     * @param string $date
     * @return array
     */
    public static function getUserRecords(int $user_id, string $date = null)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $records = Check::where('user_id', $user_id)
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->orderBy('date', 'desc')
            ->get()
            ->each(function ($record) {
                $record->duration_time = Tool::secondsToTime($record->duration);
            });

        $response['data']['records'] = $records;

        return $response;
    }
}
