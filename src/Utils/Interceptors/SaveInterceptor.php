<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class SaveInterceptor
{

    /**
     * Responsible method for intercept the data to modifications.
     *
     * @param $data Collection
     * @param $obj Model
     */
    abstract public function apply(Collection $data, Model $obj = null);

}