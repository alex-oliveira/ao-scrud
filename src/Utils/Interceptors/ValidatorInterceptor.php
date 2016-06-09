<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class ValidatorInterceptor extends BaseInterceptor
{

    /**
     * Return rules to validation.
     *
     * @param mixed $actor
     * @param $data Collection
     * @param $obj Model|mull
     * @return array
     */
    abstract protected function rules($actor, $data, $obj = null);

    /**
     * @param mixed $actor
     * @param Collection $data
     * @param Model|null $obj
     */
    public function apply($actor, $data, $obj = null)
    {
        validate($data->all(), $this->rules($actor, $data, $obj));
    }

}