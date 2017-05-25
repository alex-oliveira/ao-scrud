<?php

namespace AoScrud\Utils;

use AoScrud\Utils\Tools\Controller;
use AoScrud\Utils\Tools\Transaction;
use AoScrud\Utils\Tools\Validate;

class Tools
{

    /**
     * @return Collection
     */
    public function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * @return Controller
     */
    public function controller()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Controller();

        return $instance;
    }

    /**
     * @return Transaction
     */
    public function transaction()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Transaction();

        return $instance;
    }

    /**
     * @return Validate
     */
    public function validate()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Validate();

        return $instance;
    }

}