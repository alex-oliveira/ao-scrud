<?php

namespace AoScrud\Utils\Interceptors;

use AoScrud\Utils\Exceptions\ValidatorException;
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
     * Responsible method for validate the data of the registry.
     *
     * @param $data Collection
     * @param $obj Model
     * @throws ValidatorException
     */
    public function apply(Collection $data, Model $obj = null)
    {
        $validator = $this->validator()->make($data->all(), $this->rules($data, $obj), $this->messages(), $this->names());
        if ($validator->fails()) {
            $e = new ValidatorException('requisição inválida', 400);
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