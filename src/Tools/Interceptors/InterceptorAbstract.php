<?php

namespace AoScrud\Tools\Interceptors;

abstract class InterceptorAbstract
{

    /**
     * Responsible method for intercept the data to modifications.
     *
     * @param $data \Illuminate\Support\Collection
     */
    abstract public function apply($data);

}