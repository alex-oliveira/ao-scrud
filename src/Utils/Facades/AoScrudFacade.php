<?php

namespace AoScrud\Utils\Facades;

use AoScrud\Utils\Tools\Transaction;
use AoScrud\Utils\Tools\Validate;

class AoScrudFacade
{

    /**
     * @return Collection
     */
    public function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * @return Collection
     */
    public function paramsSearch()
    {
        return $this->params()->only('search', 'columns', 'order', 'sort', 'limit');
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

}