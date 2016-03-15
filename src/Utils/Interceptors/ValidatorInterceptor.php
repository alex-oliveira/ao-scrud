<?php

namespace AoScrud\Utils\Interceptors;

abstract class ValidatorInterceptor extends BaseInterceptor
{

    /**
     * Return rules to validation.
     *
     * @param $service \AoScrud\Services\BaseScrudService
     * @param $data \Illuminate\Support\Collection
     * @param $obj \Illuminate\Database\Eloquent\Model|mull
     * @return array
     */
    abstract protected function rules($service, $data, $obj = null);

    /**
     * Main method to intercept data.
     *
     * @param $service \AoScrud\Services\BaseScrudService
     * @param $data \Illuminate\Support\Collection
     * @param $obj \Illuminate\Database\Eloquent\Model|mull
     */
    public function apply($service, $data, $obj = null)
    {
        validate($data->all(), $this->rules($service, $data, $obj)); // , $service->messages(), $service->labels());
    }

}