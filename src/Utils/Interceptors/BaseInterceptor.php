<?php

namespace AoScrud\Utils\Interceptors;

abstract class BaseInterceptor
{

    /**
     * Main method to intercept data.
     *
     * @param $service \AoScrud\Services\BaseScrudService
     * @param $data \Illuminate\Support\Collection
     * @param $obj \Illuminate\Database\Eloquent\Model|mull
     */
    abstract public function apply($service, $data, $obj = null);

}