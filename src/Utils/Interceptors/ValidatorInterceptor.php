<?php

namespace AoScrud\Utils\Interceptors;

abstract class ValidatorInterceptor extends BaseInterceptor
{

    /**
     * Return rules to validation.
     *
     * @param mixed $actor
     * @param $data \Illuminate\Support\Collection
     * @param $obj \Illuminate\Database\Eloquent\Model|null
     * @return array
     */
    abstract protected function rules($actor, $data, $obj = null);

    /**
     * @param mixed $actor
     * @param \Illuminate\Support\Collection $data
     * @param \Illuminate\Database\Eloquent\Model|null $obj
     * @return mixed|void
     */
    public function apply($actor, $data, $obj = null)
    {
        return $this->rules($actor, $data, $obj);
    }

}