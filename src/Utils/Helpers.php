<?php

if (!function_exists('AoScrud')) {

    /**
     * @return \AoScrud\Utils\Tools
     */
    function AoScrud()
    {
        return app('AoScrud');
    }
}