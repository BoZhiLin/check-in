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

    // ------ 簽到相關 ------
    /** 本日已簽到 */
    const CHECK_IN_EXISTS = 201;
    /** 本日尚未簽到 */
    const CHECK_IN_NOT_FOUND = 202;
    /** 尚未開放打卡 */
    const CHECK_IN_NOT_OPEN = 203;
    /** 本日已簽退 */
    const CHECK_OUT_EXISTS = 204;
    /** 時間必選 */
    const CHECK_TIME_REQUIRED = 205;
    /** 時間格式有誤 */
    const CHECK_TIME_INVALID = 206;

    // ------ 請假相關 ------
    /** 請假日期必填 */
    const LEAVE_DATE_REQUIRED = 301;
    /** 請假日期 格式非法 */
    const LEAVE_DATE_INVALID = 302;
    /** 假別必選 */
    const LEAVE_TYPE_REQUIRED = 303;
    /** 假別不存在 */
    const LEAVE_TYPE_NOT_FOUND = 304;
    /** 請假開始時間 必填 */
    const LEAVE_START_REQUIRED = 305;
    /** 請假開始時間 格式非法 */
    const LEAVE_START_INVALID = 306;
    /** 請假結束時間 必填 */
    const LEAVE_END_REQUIRED = 307;
    /** 請假結束時間 格式非法 */
    const LEAVE_END_INVALID = 308;
    /** 請假時數不足 */
    const LEAVE_TIMES_NOT_ENOUGH = 309;
    /** 查無請假資訊 */
    const LEAVE_NOT_FOUND = 310;
}
