<?php

if (!function_exists('AoScrud')) {

    /**
     * @return \AoScrud\Utils\Tools\Kit
     */
    function AoScrud()
    {
        return app('AoScrud');
    }
}