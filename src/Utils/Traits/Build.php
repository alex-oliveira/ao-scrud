<?php

namespace AoScrud\Utils\Traits;

trait Build
{

    /**
     * @var self
     */
    protected static $build = null;

    /**
     * @return self
     */
    public static function build()
    {
        return is_null(self::$build) ? self::$build = new self : self::$build;
    }

}
