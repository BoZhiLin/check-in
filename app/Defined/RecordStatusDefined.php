<?php

namespace App\Defined;

abstract class RecordStatusDefined
{
    /** 一般上/下班 */
    const NORMAL = 'NORMAL';

    /** 事假 */
    const PERSONAL = 'PERSONAL';

    /** 病假 */
    const SICK = 'SICK';

    /** 特休 */
    const SPECIAL = 'SPECIAL';

    public static function all()
    {
        return [
            self::NORMAL,
            self::PERSONAL,
            self::SICK,
            self::SPECIAL,
        ];
    }
}
