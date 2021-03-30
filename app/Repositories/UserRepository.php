<?php

namespace App\Repositories;

use App\Models\User;

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
        $model = new static::$model($data);

        $prefix = substr(date('Ymd'), 2, 6);
        $serial = str_pad(User::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $model->serial_number = $prefix . '-' . $serial;
        $model->save();

        return $model;
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
}
