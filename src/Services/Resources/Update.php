<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\InterceptorAbstract;
use AoScrud\Utils\Validators\ValidatorAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * The formatter class to update in the repository.
     *
     * @var InterceptorAbstract
     */
    protected $updateInterceptor;

    /**
     * The validator class to update in repository.
     *
     * @var ValidatorAbstract
     */
    protected $updateValidator;

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update in the repository.
     *
     * @param array $params
     * @param array $keys
     * @return bool
     * @throws \Exception
     */
    public function update(array $params = null, array $keys = null)
    {
        $params = is_null($params) ? $this->updateParams() : collect($params);

        $obj = $this->updateSelect($keys);

        $this->updateInterceptor($params);
        $this->updateValidator($params, $obj);

        $this->tBegin();
        try {
            $status = $this->updateSave($params, $obj);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $status;
    }

    //------------------------------------------------------------------------------------------------------------------
    // CUSTOMS METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the data of request to update.
     *
     * @return Collection
     */
    protected function updateParams()
    {
        return $this->params();
    }

    /**
     * Return the object the should be updated.
     *
     * @param array $keys
     * @return Model $obj
     */
    protected function updateSelect(array $keys = null)
    {
        return $this->read($keys, false);
    }

    /**
     * Run interceptor class in data of request.
     *
     * @param Collection $params
     * @return array
     */
    protected function updateInterceptor($params)
    {
        if (isset($this->updateInterceptor)) {
            if (is_string($this->updateInterceptor) && is_subclass_of($this->updateInterceptor, InterceptorAbstract::class)) {
                $this->updateInterceptor = app($this->updateInterceptor);
            }
            is_object($this->updateInterceptor) ? $this->updateInterceptor->apply($params) : null;
        }
    }

    /**
     * Run validator class in data of request.
     *
     * @param Collection $params
     * @param Model $obj
     * @return array
     */
    protected function updateValidator($params, $obj)
    {
        if (isset($this->updateValidator)) {
            if (is_string($this->updateValidator) && is_subclass_of($this->updateValidator, ValidatorAbstract::class)) {
                $this->updateValidator = app($this->updateValidator);
            }
            is_object($this->updateValidator) ? $this->updateValidator->apply($params, $obj) : null;
        }
    }

    /**
     * Run update command in the repository.
     *
     * @param Collection $params
     * @param Model $obj
     * @return bool
     */
    protected function updateSave($params, $obj)
    {
        $obj->fill($params->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}