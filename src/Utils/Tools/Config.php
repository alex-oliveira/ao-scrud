<?php

namespace AoScrud\Utils\Tools;

class Config
{

    /**
     * @param array|string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key = null, $default = null)
    {
        $config = config($key, $default);

        if ($config instanceof \Closure)
            return $config();

        return $config;
    }

}