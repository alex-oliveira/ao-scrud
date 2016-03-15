<?php

namespace AoScrud\Utils\Interceptors;

abstract class BaseInterceptor
{

    /**
     * Main method to intercept data.
     *
     * @param \AoScrud\Services\ScrudService $service
     * @param \Illuminate\Support\Collection $data
     * @param \Illuminate\Database\Eloquent\Model|mull $obj
     */
    abstract public function apply($service, $data, $obj = null);

}