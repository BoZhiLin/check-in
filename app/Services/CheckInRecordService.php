<?php

namespace App\Services;

use Carbon\Carbon;

use App\Defined\System;
use App\Defined\ApiResponse;
use App\Defined\RecordStatus;

use App\Repositories\CheckInRecordRepository;

use App\Tools\Tool;

class CheckInRecordService
{
    /**
     * 當天簽到
     * 
     * @param int $user_id
     * @return array
     */
    public static function checkInByUser(int $user_id)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $work_on_time = System::NORMAL_WORK_TIME;
        $current_day_record = CheckInRecordRepository::getTodayByUser($user_id);

        if (!is_null($current_day_record)) {
            $response['status'] = ApiResponse::CHECK_IN_EXISTS;
        } elseif (now()->lt(Carbon::parse(date("Y-m-d $work_on_time")))) {
            $response['status'] = ApiResponse::CHECK_IN_NOT_OPEN;
        } else {
            $record = CheckInRecordRepository::create([
                'user_id' => $user_id,
                'status' => RecordStatus::NORMAL,
                'started_at' => now()
            ]);

            $response['data']['record'] = $record;
        }

        return $response;
    }

    /**
     * 當天簽退
     * 
     * @param int $user_id
     * @return array
     */
    public static function checkOutByUser(int $user_id)
    {
        $response = ['status' => ApiResponse::SUCCESS];
        $current_day_record = CheckInRecordRepository::getTodayByUser($user_id);

        if (is_null($current_day_record)) {
            $record = CheckInRecordRepository::create([
                'user_id' => $user_id,
                'status' => RecordStatus::NORMAL,
                'ended_at' => now()
            ]);

            $response['data']['record'] = $record;
        } else {
            if (!is_null($current_day_record->ended_at)) {
                $response = ['status' => ApiResponse::CHECK_OUT_EXISTS];
            } else {
                $now_time = now()->toTimeString();
                $duration = $current_day_record->started_at ? Tool::duration(
                        $now_time, 
                        $current_day_record->started_at->toTimeString()
                    ) : 0;
    
                $current_day_record->duration = $duration;
                $current_day_record->ended_at = $now_time;
                $current_day_record->save();
    
                $response['data']['record'] = $current_day_record;
            }
        }

        return $response;
    }

    /** 當日過後補打卡 */
    public static function recoup()
    {
        // TODO
    }
}
