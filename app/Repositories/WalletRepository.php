<?php

namespace App\Repositories;

use Latrell\Lock\Facades\Lock;

class WalletRepository extends Repository
{
    protected static $model = \App\Models\Wallet::class;

    public static function getByUser(int $user_id, string $type)
    {
        $lock_key = "wallet@user:$user_id";

        try {
            Lock::acquire($lock_key);

            $wallet = static::$model::firstOrCreate(
                ['user_id' => $user_id, 'type' => $type],
                ['balance_available' => 0]
            );
        } finally {
            Lock::release($lock_key);
        }

        return $wallet;
    }
}
