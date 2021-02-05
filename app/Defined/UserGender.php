<?php

namespace App\Defined;

abstract class UserGender
{
    /** 男性 */
    const MALE = 1;

    /** 女性 */
    const FEMALE = 2;

    /** 其他 */
    const OTHER = 3;

    public static function all()
    {
        return [
            self::MALE,
            self::FEMALE,
            self::OTHER,
        ];
    }
}
