<?php

namespace AoScrud\Services\Resources\Create;

use AoScrud\Tools\Interceptors\InterceptorAbstract;
use AoScrud\Tools\Validators\ValidatorAbstract;
use Exception;
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
    // MASTERS //-------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array|null $data
     * @return Model
     * @throws Exception
     */
    public function create(array $data = null)
    {
        $data = is_null($data) ? $this->createData() : collect($data);

        $this->createInterceptor($data);
        $this->createValidator($data);

        $this->tBegin();
        try {
            $obj = $this->createSave($data);
        } catch (Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $obj;
    }

    /**
     * Return the data of request to registry.
     *
     * @return Collection
     */
    protected function createData()
    {
        return $this->data();
    }

    /**
     * Run interceptor class in data of request.
     *
     * @param Collection $data
     * @return array
     */
    protected function createInterceptor($data)
    {
        if (isset($this->createInterceptor)) {
            if (is_string($this->createInterceptor) && is_subclass_of($this->createInterceptor, InterceptorAbstract::class)) {
                $this->createInterceptor = app($this->createInterceptor);
            }
            is_object($this->createInterceptor) ? $this->createInterceptor->apply($data) : null;
        }
    }

    /**
     * Run validator class in data of request.
     *
     * @param Collection $data
     * @return array
     */
    protected function createValidator($data)
    {
        if (isset($this->createValidator)) {
            if (is_string($this->createValidator) && is_subclass_of($this->createValidator, ValidatorAbstract::class)) {
                $this->createValidator = app($this->createValidator);
            }
            is_object($this->createValidator) ? $this->createValidator->apply($data) : null;
        }
    }

    /**
     * Run create command in the repository.
     *
     * @param Collection $data
     * @return array
     */
    protected function createSave($data)
    {
        return $this->rep->create($data->all());
    }

}