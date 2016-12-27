<?php

if (!function_exists('AoScrud')) {

    /**
     * @return \AoScrud\Utils\Facades\AoScrudFacade
     */
    function AoScrud()
    {
        return app('AoScrud');
    }

}