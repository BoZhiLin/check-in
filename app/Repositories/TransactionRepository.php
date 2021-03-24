<?php

namespace App\Repositories;

use Latrell\Lock\Facades\Lock;

use App\Models\Wallet;

class TransactionRepository extends Repository
{
    protected static $model = \App\Models\Transaction::class;

    public static function createByWallet(Wallet $wallet, string $type, $value, array $link = null)
    {
        if ($value != 0) {
            $transaction = new static::$model();
            $transaction->user_id = $wallet->user_id;
            $transaction->wallet_id = $wallet->id;
            $transaction->leave_type = $wallet->leave_type;
            $transaction->value = $value;
            $transaction->type = $type;

            if ($link) {
                $transaction->link = $link;
            }

            $lock_key = 'transaction@wallet:' . $wallet->id;

            try {
                Lock::acquire($lock_key);

                $transaction->before = $wallet->balance_available;
                $transaction->after = $wallet->balance_available + $value;
                $wallet->increment('balance_available', $value);
                $transaction->save();
            } finally {
                Lock::release($lock_key);
            }

            return $transaction;
        }
    }
}