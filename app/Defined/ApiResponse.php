<?php

namespace App\Defined;

abstract class ApiResponse
{
    /** 成功 */
    const SUCCESS = 0;

    // ------ 參數驗證預設錯誤碼 ------
    /** 參數驗證有誤 */
    const UNDEFINED_ARGUMENT = 100;

    // ------ 登入認證相關 ------
    /** 登入失敗 */
    const UNAUTHORIZED = 101;
    /** 憑證非法 */
    const TOKEN_INVALID = 102;
    /** Token過期 */
    const TOKEN_EXPIRED = 103;
    /** 查無使用者 */
    const USER_NOT_FOUND = 104;

    /** 本日已簽到 */
    const CHECK_IN_EXISTS = 201;
    /** 本日尚未遷到 */
    const CHECK_IN_NOT_FOUND = 202;
}
