<?php

namespace App\Repositories;

use App\Models\CheckInRecord;

class CheckInRecordRepository extends Repository
{
    public static function create(array $data)
    {
        $record = new CheckInRecord();
        $record->user_id = $data['user_id'];
        $record->status = $data['status'];

        if (isset($data['started_at'])) {
            $record->started_at = $data['started_at'];
        }
        if (isset($data['ended_at'])) {
            $record->ended_at = $data['ended_at'];
        }

        $record->save();

        return $record;
    }

    public static function getTodayByUser(int $user_id)
    {
        return CheckInRecord::where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereDate('started_at', today())
                    ->orWhereDate('ended_at', today());
            })
            ->first();
    }

    public static function getModel()
    {
        return CheckInRecord::class;
    }
}
