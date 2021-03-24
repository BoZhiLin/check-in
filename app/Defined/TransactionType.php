<?php

namespace App\Defined;

abstract class TransactionType
{
    /** 請假申請 */
    const LEAVE_REPLY = 'LEAVE_REPLY';
    /** 退還時數 */
    const RETURN_BALANCE = 'RETURN_BALANCE';
}
