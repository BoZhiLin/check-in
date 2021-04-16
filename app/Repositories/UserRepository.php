<?php

namespace App\Repositories;

use App\Models\User;

use App\Defined\ChangeLog;

use App\Tools\Tool;

class UserRepository extends Repository
{
    protected static $model = User::class;

    public static function all()
    {
        return static::$model::all()
            ->map(function ($user) {
                return [
                    'serial_number' => $user->serial_number,
                    'name' => $user->name,
                    'gender' => $user->gender,
                    'birthday' => $user->birthday,
                    'age' => Tool::getAge($user->birthday),
                    'address' => $user->address,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'report_date' => $user->report_date
                ];
            });
    }

    public static function save(array $data)
    {
        $user = new static::$model($data);

        $prefix = substr(date('Ymd'), 2, 6);
        $serial = str_pad(User::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $user->serial_number = $prefix . '-' . $serial;
        $user->save();

        $user->userChangeLogs()->create([
            'type' => ChangeLog::TYPE_REPORT,
            'date' => $data['report_date']
        ]);

        return $user;
    }

    public static function update(int $user_id, array $data)
    {
        $user = static::$model::find($user_id);

        foreach ($data as $key => $value) {
            $user->$key = $value;
        }

        $user->save();

        return $user;
    }

    public static function setLeave(User $user, string $date)
    {
        $user->userChangeLogs()->create([
            'type' => ChangeLog::TYPE_LEAVE,
            'date' => $date
        ]);

        $user->is_active = false;
        $user->leave_date = $date;
        $user->save();
    }

    public static function setActive(User $user, string $date)
    {
        $user->userChangeLogs()->create([
            'type' => ChangeLog::TYPE_REPORT,
            'date' => $date
        ]);

        $user->is_active = true;
        $user->report_date = $date;
        $user->leave_date = null;
        $user->save();
    }
}
