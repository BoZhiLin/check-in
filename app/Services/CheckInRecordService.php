<?php

namespace App\Services;

use App\Defined\ResponseDefined;
use App\Defined\RecordStatusDefined;

use App\Repositories\CheckInRecordRepository;

class CheckInRecordService
{
    /** 簽到 */
    public static function signIn(int $user_id)
    {
        $result = ['status' => ResponseDefined::SUCCESS];
        $current_day_record = CheckInRecordRepository::getCurrentByUser($user_id);

        /** TODO: 防呆還沒做(上/下班時間) */
        if (!is_null($current_day_record)) {
            $result['status'] = ResponseDefined::CHECK_IN_EXISTS;
        } else {
            $data = [
                'user_id' => $user_id,
                'status' => RecordStatusDefined::NORMAL,
                'sign_in_at' => now()
            ];
            $record = CheckInRecordRepository::signIn($data);
            $result['data']['record'] = $record;
        }

        return $result;
    }

    /** 簽退 */
    public static function signOut(int $user_id)
    {
        $result = ['status' => ResponseDefined::SUCCESS];
        $current_day_record = CheckInRecordRepository::getCurrentByUser($user_id);

        if (is_null($current_day_record)) {
            $result['status'] = ResponseDefined::CHECK_IN_NOT_FOUND;
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
