<?php

namespace App\Defined;

abstract class ResponseDefined
{
    /** 成功 */
    const SUCCESS = 0;

    /** 帳號 */
    // TODO

    /** 本日已簽到 */
    const CHECK_IN_EXISTS = 201;
    /** 本日尚未遷到 */
    const CHECK_IN_NOT_FOUND = 202;
}
