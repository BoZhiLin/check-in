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
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function save(array $data)
    {
        $model = new static::$model($data);
        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function update(int $id, array $data)
    {
        $model = static::$model::find($id);

        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        
        $model->save();

        return $model;
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
