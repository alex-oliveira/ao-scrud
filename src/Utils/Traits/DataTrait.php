<?php

namespace AoScrud\Utils\Traits;

trait DataTrait
{

    public static function dArray()
    {
        return self::$data;
    }

    public static function dKeys()
    {
        return array_keys(self::$data);
    }

    public static function dItem($id)
    {
        return self::$data[$id];
    }

    public static function dCollect()
    {
        return collect(self::$data);
    }

}