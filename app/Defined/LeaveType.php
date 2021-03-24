<?php

namespace App\Defined;

abstract class LeaveType
{
    /** 事假 */
    const PERSONAL = 'PERSONAL';

    /** 病假 */
    const SICK = 'SICK';

    /** 特休 */
    const SPECIAL = 'SPECIAL';

    /** 補休 */
    const RECOUP = 'RECOUP';

    public static function all()
    {
        return [
            self::PERSONAL,
            self::SICK,
            self::SPECIAL,
            self::RECOUP,
        ];
    }
}
