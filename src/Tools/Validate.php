<?php

namespace AoScrud\Tools;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Support\Collection;

class Validate
{

    /**
     * @var mixed
     */
    protected $actor = null;

    /**
     * @var mixed
     */
    protected $obj = null;

    /**
     * @var Collection
     */
    protected $data = null;

    /**
     * @var mixed
     */
    protected $rules = [];

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
     * @param mixed $obj
     * @return $this
     */
    public function obj($obj)
    {
        $this->obj = $obj;
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
     * @param string|array|Collection $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = $rules instanceof Collection ? $rules->all() : $rules;
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
        if ($this->rules instanceof Collection)
            $this->rules = $this->rules->all();

        if (is_string($this->rules) && is_subclass_of($this->rules, BaseInterceptor::class))
            $this->rules = app($this->rules)->apply($this->actor, $this->data, $this->obj);

        $validator = app('validator')->make($this->data->all(), $this->rules, $this->messages, $this->labels);

        if ($validator->fails())
            abort(400, json_encode($validator->errors()->all()));

        return $validator;
    }

}