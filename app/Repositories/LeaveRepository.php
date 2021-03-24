<?php

namespace App\Repositories;

class LeaveRepository extends Repository
{
    protected static $model = \App\Models\Leave::class;

    public static function create(array $data)
    {
        $leave = new static::$model();
        $leave->user_id = $data['user_id'];
        $leave->date = $data['date'];
        $leave->type = $data['type'];
        $leave->started_time = $data['started_time'];
        $leave->ended_time = $data['ended_time'];
        $leave->duration = $data['total_seconds'];
        $leave->status = $data['status'];

        $leave->save();
    }

    public static function getByUser(int $user_id, string $sort = 'asc')
    {
        return static::$model::where('user_id', $user_id)
            ->orderBy('id', $sort)
            ->get();
    }
}
