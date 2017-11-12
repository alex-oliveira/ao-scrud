<?php

namespace AoScrud\Traits\Interfaces;

interface IAoDataTrait
{

    /**
     * @return array
     */
    public static function keys();

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function collect();

    /**
     * @return array
     */
    public static function get();

    /**
     * @return mixed
     */
    public static function getByKey($key);

}
