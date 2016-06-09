<?php

namespace AoScrud\Utils\Facades;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Support\Collection;

class ValidateFacade
{

    /**
     * @var mixed
     */
    protected $actor = null;

    /**
     * @var mixed
     */
    protected $data = null;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var mixed
     */
    protected $obj = null;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @var array
     */
    protected $labels = [];

    /**
     * @param mixed $actor
     * @return $this
     */
    public function actor($actor)
    {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @param Collection $data
     * @return $this
     */
    public function data(Collection $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array|string $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @param mixed $obj
     * @return $this
     */
    public function obj($obj)
    {
        $this->obj = $obj;
        return $this;
    }

    /**
     * @param array $messages
     * @return $this
     */
    public function messages(array $messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @param array $labels
     * @return $this
     */
    public function labels(array $labels)
    {
        $this->labels = $labels;
        return $this;
    }

    //------------------------------------------------------------------------------------------------------------------

    public function run()
    {
        if (is_string($this->rules) && is_subclass_of($this->rules, BaseInterceptor::class))
            $this->rules = app($this->rules)->apply($this->actor, $this->data);

        $validator = app('validator')->make($this->data->all(), $this->rules, $this->messages, $this->labels);

        if ($validator->fails())
            abort(400, json_encode($validator->errors()->all()));

        return $validator;
    }

}