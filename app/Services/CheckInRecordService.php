<?php

namespace App\Services;

use App\Defined\System;
use App\Defined\ApiResponse;
use App\Defined\RecordStatus;

use App\Models\CheckInRecord;

class CheckInRecordService
{
    /** 簽到 */
    public static function signInByUser(int $user_id)
    {
        $result = ['status' => ApiResponse::SUCCESS];
        $current_day_record = CheckInRecord::where('user_id', $user_id)
            ->whereDate('created_at', today())
            ->first();

        /** TODO: 防呆還沒做(上/下班時間) */
        if (!is_null($current_day_record)) {
            $result['status'] = ApiResponse::CHECK_IN_EXISTS;
        } else {
            $record = new CheckInRecord();
            $record->user_id = $user_id;
            $record->status = RecordStatus::NORMAL;
            $record->sign_in_at = now();
            $record->save();
        }

        return $result;
    }

    /** 簽退 */
    public static function signOutByUser(int $user_id)
    {
        $result = ['status' => ApiResponse::SUCCESS];
        $current_day_record = CheckInRecord::where('user_id', $user_id)
            ->whereDate('created_at', today())
            ->first();

        if (is_null($current_day_record)) {
            $result['status'] = ApiResponse::CHECK_IN_NOT_FOUND;
        } else {
            $now_time = now()->toDateTimeString();
            $duration = date('H:i:s', strtotime($current_day_record->sign_in_at) - strtotime($now_time));
            $current_day_record->sign_out_at = $now_time;
            // $current_day_record->duration = $duration;
            $current_day_record->save();

            $result['data']['record'] = $current_day_record;
        }

        return $result;
    }

    /** 補打卡 */
    public static function recoup()
    {
        // TODO
    }
}
