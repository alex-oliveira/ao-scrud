<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Support\Collection;

abstract class FilterInterceptor
{

    /**
     * Main method to intercept data.
     *
     * @param $data Collection
     */
    abstract public function apply(Collection $data);

}