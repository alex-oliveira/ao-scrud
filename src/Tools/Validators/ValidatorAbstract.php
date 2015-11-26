<?php

namespace AoScrud\Tools\Validators;

use AoScrud\Tools\Exceptions\MultiException;

abstract class ValidatorAbstract
{

    protected $names;
    protected $messages;

    /**
     * @param $data \Illuminate\Support\Collection
     * @param $model \Illuminate\Database\Eloquent\Model
     * @return array
     */
    abstract protected function rules($data, $model = null);

    /**
     * Responsible method for validate the data of the registry.
     *
     * @param $data \Illuminate\Support\Collection
     * @param $model \Illuminate\Database\Eloquent\Model
     * @throws MultiException
     */
    public function apply($data, $model = null)
    {
        $validator = $this->validator()->make($data->all(), $this->rules($data, $model), $this->messages(), $this->names());
        if ($validator->fails()) {
            $e = new MultiException('dados inválidos', 400);
            $e->setIssues($validator->errors()->all());
            throw $e;
        }
    }

    /**
     * @return \Illuminate\Validation\Factory
     */
    protected function validator()
    {
        return app('validator');
    }

    protected function names()
    {
        if (isset($this->names)) {
            if (is_array($this->names)) {
                return $this->names;
            } elseif (is_string($this->names)) {
                // tentar ler arquivo com nome igual a string
            }
        }
        return [];
    }

    protected function messages()
    {
        if (isset($this->messages)) {
            if (is_array($this->messages)) {
                return $this->messages;
            } elseif (is_string($this->messages)) {
                // tentar ler arquivo com nome igual a string
            }
        }
        return [];
    }

}