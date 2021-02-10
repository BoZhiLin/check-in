<?php

namespace App\Defined;

abstract class System
{
    /** 常設上班時間 (H:i:s) */
    const NORMAL_WORK_TIME = '08:30:00';

    /** 休息開始時間 */
    const REST_START_TIME = '12:00:00';

    /** 休息結束時間 */
    const REST_END_TIME = '13:00:00';
}
