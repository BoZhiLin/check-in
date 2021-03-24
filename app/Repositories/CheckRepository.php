<?php

namespace App\Repositories;

class CheckRepository extends Repository
{
    protected static $model = \App\Models\Check::class;

    public static function create(array $data)
    {
        $check = new static::$model();
        $check->date = $data['date'];
        $check->user_id = $data['user_id'];
        $check->started_time = $data['started_time'];
        $check->save();

        return $check;
    }

    public static function getUserRecordByDate(int $user_id, string $date)
    {
        return static::$model::where('user_id', $user_id)
            ->whereDate('date', $date)
            ->first();
    }
}
