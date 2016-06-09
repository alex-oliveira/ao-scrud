<?php

if (!function_exists('transaction')) {

    /**
     * @return \AoScrud\Utils\Facades\TransactionFacade
     */
    function transaction()
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