<?php

if (!function_exists('AoScrud')) {

    /**
     * @return \AoScrud\Tools
     */
    function AoScrud()
    {
        return app('AoScrud');
    }
}