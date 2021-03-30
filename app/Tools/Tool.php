<?php

namespace App\Tools;

use Carbon\Carbon;
use App\Defined\System;

class Tool
{
    /**
     * 計算當日上班工時 (需扣除休息時間)
     * 
     * @param string $work_off (下班時間)
     * @param string $work_on (上班時間)
     * @param bool $is_time_format (是否轉為時間格式)
     * @return int
     */
    public static function duration(string $work_off, string $work_on, bool $is_time_format = false)
    {
        $rest_time = 0;
        $work_off_dt = Carbon::parse($work_off);
        $work_on_dt = Carbon::parse($work_on);
        $rest_start_dt = Carbon::parse(System::REST_START_TIME);
        $rest_end_dt = Carbon::parse(System::REST_END_TIME);

        /** 1.正常上/下班  2.上下班均非正常 3.上班正常/下班非正常 4.上班非正常/下班正常 */
        if ($work_on_dt->lt($rest_start_dt) && $work_off_dt->gt($rest_end_dt)) {
            $rest_time = 3600;
        } elseif ($work_on_dt->gte($rest_start_dt) && $work_off_dt->lte($rest_end_dt)) {
            $rest_time = 0;
        } elseif (
            $work_on_dt->lt($rest_start_dt) &&
            ($work_off_dt->gte($rest_start_dt) && $work_off_dt->lte($rest_end_dt))
        ) {
            $rest_time = strtotime($work_off) - strtotime(System::REST_START_TIME);
        } elseif (
            ($work_on_dt->gte($rest_start_dt) && $work_on_dt->lte($rest_end_dt)) &&
            $work_off_dt->gt($rest_end_dt)
        ) {
            $rest_time = strtotime(System::REST_END_TIME) - strtotime($work_on);
        }

        $result = strtotime($work_off) - strtotime($work_on) - $rest_time;

        if ($is_time_format) {
            $result = static::secondsToTime($result);
        }

        return $result;
    }

    /**
     * 秒數轉換為時間格式 (hh:mm:ss)
     * 
     * @param int $diff_in_seconds
     * @return string (格式 hh:mm:ss)
     */
    public static function secondsToTime(int $diff_in_seconds)
    {
        $second = $diff_in_seconds % 60;
        $minute = (int) ($diff_in_seconds / 60);
        $hour = 0;

        if ($minute >= 60) {
            $hour = (int) ($minute / 60);
            $minute = $minute % 60;
        }

        $hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
        $minute = str_pad($minute, 2, '0', STR_PAD_LEFT);
        $second = str_pad($second, 2, '0', STR_PAD_LEFT);

        return implode(':', [$hour, $minute, $second]);
    }

    /**
     * 計算年齡
     * 
     * @param string $date
     * @return int
     */
    public static function getAge(string $date)
    {
        return Carbon::now()->diffInYears(Carbon::parse($date));
    }
}
