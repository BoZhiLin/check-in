<?php

namespace App\Repositories;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected static $model;

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function all()
    {
        return static::$model::get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findByPrimary(int $id)
    {
        return static::$model::find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function delete(int $id)
    {
        return static::$model::destroy($id);
    }
}
