<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;

abstract class DestroyInterceptor
{

    /**
     * Main method to intercept objects.
     *
     * @param $obj Model
     */
    abstract public function apply(Model $obj);

}