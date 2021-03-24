<?php

namespace App\Defined;

abstract class LeaveStatus
{
    /** 審核中 */
    const PROGRESSING = 'PROGRESSING';
    /** 已通過 */
    const PASSED = 'PASSED';
    /** 駁回 */
    const REJECT = 'REJECT';
}
