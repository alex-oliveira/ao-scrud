<?php

namespace AoScrud\Utils\Interceptors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class SaveValidatorInterceptor extends SaveInterceptor
{

    protected $names;
    protected $messages;

    /**
     * @param $data Collection
     * @param $obj Model
     * @return array
     */
    abstract protected function rules(Collection $data, Model $obj = null);

    /**
     * @return \Illuminate\Validation\Factory
     */
    protected function validator()
    {
        return app('validator');
    }

    /**
     * Responsible method for validate the data of the registry.
     *
     * @param $data Collection
     * @param $obj Model
     */
    public function apply(Collection $data, Model $obj = null)
    {
        $validator = $this->validator()->make($data->all(), $this->rules($data, $obj), $this->messages(), $this->names());
        if ($validator->fails())
            abort(412, json_encode($validator->errors()->all()));
    }

    protected function names()
    {
        return [];
    }

    protected function messages()
    {
        return [];
    }

}