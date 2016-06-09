<?php

namespace AoScrud\Utils\Traits;

trait Data
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function collect()
    {
        static $collection = null;
        return is_null($collection) ? $collection = collect(self::$data) : $collection;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return array
     */
    public static function data()
    {
        return self::$data;
    }

    /**
     * @return bool
     */
    public static function has($key)
    {
        return isset(self::$data[$key]);
    }

    /**
     * @return array
     */
    public static function get($id)
    {
        return (object)self::$data[$id];
    }

    /**
     * @return bool
     */
    public static function in($value)
    {
        return in_array($value, self::$data);
    }

    /**
     * @return array
     */
    public static function keys()
    {
        return array_keys(self::$data);
    }

    /**
     * @param string $glue
     * @return string
     */
    public static function implode($glue = ',')
    {
        return implode($glue, self::keys());
    }

}