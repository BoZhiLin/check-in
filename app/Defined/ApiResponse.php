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

    // ------ User相關 ------
    /** 姓名必填 */
    const USER_NAME_REQUIRED = 401;
    /** 性別必選 */
    const USER_GENDER_REQUIRED = 402;
    /** 性別不存在 */
    const USER_GENDER_NOT_FOUND = 403;
    /** 身分證必填 */
    const USER_ID_REQUIRED = 404;
    /** 身分證已存在 */
    const USER_ID_EXISTS = 405;
    /** 生日必填 */
    const USER_BIRTHDAY_REQUIRED = 406;
    /** 生日格式非法 */
    const USER_BIRTHDAY_INVALID = 407;
    /** 地址必填 */
    const USER_ADDRESS_REQUIRED = 408;
    /** 帳號必填 */
    const USER_ACCOUNT_REQUIRED = 409;
    /** 帳號已存在 */
    const USER_ACCOUNT_EXISTS = 410;
    /** 密碼必填 */
    const USER_PASSWORD_REQUIRED = 411;
    /** 電話必填 */
    const USER_PHONE_REQUIRED = 412;
    /** 報到日必選 */
    const USER_REPORT_REQUIRED = 413;
    /** 報到日期非法 */
    const USER_REPORT_INVALID = 414;
}
