<?php

namespace AoScrud\Utils\Traits;

trait BuildTrait
{

    /**
     * @return $this
     */
    public static function build()
    {
        static $build = null;
        return is_null($build) ? $build = new self : $build;
    }

}
