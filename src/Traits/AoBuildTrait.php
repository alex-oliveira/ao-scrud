<?php

namespace AoScrud\Traits;

trait AoBuildTrait
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
