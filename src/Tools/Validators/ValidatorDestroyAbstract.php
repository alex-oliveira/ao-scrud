<?php

namespace AoScrud\Tools\Validators;

use AoScrud\Tools\Exceptions\MultiException;

abstract class ValidatorDestroyAbstract
{

    /**
     * Responsible method for validate the data of the registry.
     *
     * @param \Illuminate\Database\Eloquent\Model $obj
     * @throws MultiException
     */
    abstract public function verify($obj);

}