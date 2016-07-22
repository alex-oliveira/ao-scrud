<?php

if (!function_exists('scrud')) {

    /**
     * @return \AoScrud\Utils\Facades\ScrudFacade
     */
    function scrud()
    {
        return app('scrud');
    }

}

if (!function_exists('transaction')) {

    /**
     * @return \AoScrud\Utils\Facades\TransactionFacade
     */
    function Transaction()
    {
        return app('transaction');
    }

}

if (!function_exists('validate')) {

    /**
     * @return \AoScrud\Utils\Facades\ValidateFacade
     */
    function validate()
    {
        return app('validate');
    }

}
