<?php

namespace AoScrud\Traits;

trait AoDataTrait
{

    /**
     * @return array
     */
    public static function keys()
    {
        return array_keys(self::$data);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function collect()
    {
        return collect(self::$data);
    }

    /**
     * @return array
     */
    public static function get()
    {
        return self::$data;
    }

    /**
     * @return mixed
     */
    public static function getByKey($key)
    {
        return self::$data[$key];
    }

}