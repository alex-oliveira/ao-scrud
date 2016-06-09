<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseInterceptor
{

    /**
     * Main method to intercept data.
     *
     * @param mixed $actor
     * @param Collection $data
     * @param Model|mull $obj
     */
    abstract public function apply($actor, $data, $obj = null);

}