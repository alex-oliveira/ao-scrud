<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseInterceptor
{

    /**
     * Responsible method for intercept the data to modifications.
     *
     * @param $data Collection
     * @param $model Model
     */
    abstract public function apply(Collection $data, Model $model = null);

}