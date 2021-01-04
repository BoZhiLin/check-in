<?php

namespace App\Repositories;

use App\Models\CheckInRecord;

class CheckInRecordRepository
{
    /**
     * 簽到
     * 
     * @param array $data (user_id, status, sign_in_at)
     * @return CheckInRecord
     */
    public static function signIn(array $data)
    {
        $record = new CheckInRecord();
        $record->user_id = $data['user_id'];
        $record->status = $data['status'];
        $record->sign_in_at = $data['sign_in_at'];
        $record->save();

        return $record;
    }

    /**
     * 取得當日簽到紀錄
     * 
     * @param int $user_id
     * @return CheckInRecord
     */
    public static function getCurrentByUser(int $user_id)
    {
        return CheckInRecord::where('user_id', $user_id)
            ->whereDate('created_at', today())
            ->first();
    }
}
