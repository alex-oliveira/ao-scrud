<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\InterceptorAbstract;
use AoScrud\Utils\Validators\ValidatorAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{

    /**
     * The interceptor class to registry in the repository.
     *
     * @var InterceptorAbstract
     */
    protected $createInterceptor;

    /**
     * The validator class to registry in repository.
     *
     * @var ValidatorAbstract
     */
    protected $createValidator;

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array|null $params
     * @return Model
     * @throws Exception
     */
    public function create(array $params = null)
    {
        $params = is_null($params) ? $this->createParams() : collect($params);

        $this->createInterceptor($params);
        $this->createValidator($params);

        $this->tBegin();
        try {
            $obj = $this->createSave($params);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // CUSTOMS METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the data of request to registry.
     *
     * @return Collection
     */
    protected function createParams()
    {
        return $this->params();
    }

    /**
     * Run interceptor class in data of request.
     *
     * @param Collection $params
     * @return array
     */
    protected function createInterceptor($params)
    {
        if (isset($this->createInterceptor)) {
            if (is_string($this->createInterceptor) && is_subclass_of($this->createInterceptor, InterceptorAbstract::class)) {
                $this->createInterceptor = app($this->createInterceptor);
            }
            is_object($this->createInterceptor) ? $this->createInterceptor->apply($params) : null;
        }
    }

    /**
     * Run validator class in data of request.
     *
     * @param Collection $params
     * @return array
     */
    protected function createValidator($params)
    {
        if (isset($this->createValidator)) {
            if (is_string($this->createValidator) && is_subclass_of($this->createValidator, ValidatorAbstract::class)) {
                $this->createValidator = app($this->createValidator);
            }
            is_object($this->createValidator) ? $this->createValidator->apply($params) : null;
        }
    }

    /**
     * Run create command in the repository.
     *
     * @param Collection $params
     * @return array
     */
    protected function createSave($params)
    {
        return $this->rep->create($params->all());
    }

}