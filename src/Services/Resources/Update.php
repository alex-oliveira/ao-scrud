<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\InterceptorAbstract;
use AoScrud\Utils\Validators\ValidatorAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PhpSpec\Exception\Exception;

trait Update
{

    /**
     * The allow fields to update.
     *
     * @var array
     */
    protected $updateFillable = [];

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
     * @param Collection $data
     * @param array $keys
     * @return bool
     * @throws Exception
     */
    public function update(Collection $data = null, array $keys = null)
    {
        $obj = $this->updateSelect($keys);

        $this->updatePrepare(is_null($data) ? $data = $this->updateParams() : $data, $obj);


        $this->updateInterceptor($data);
        $this->updateValidator($data, $obj);

        $this->tBegin();
        try {
            $status = $this->updateSave($data, $obj);
        } catch (Exception $e) {
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
     * Return the data of request to update.
     *
     * @return Collection
     */
    protected function updateParams()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * Run all preparations before update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updatePrepare(Collection $data, Model $obj)
    {
        $this->updateFillable();
        $this->updateInterceptor($data, $obj);
        $this->updateValidator($data, $obj);
    }

    /**
     * Define the allow fields to update.
     */
    protected function updateFillable()
    {
        $this->modelCurrent()->fillable($this->updateFillable);
    }

    /**
     * Run interceptor class in data of request.
     *
     * @param Collection $data
     * @param Model $obj
     * @return array
     */
    protected function updateInterceptor($data, $obj)
    {
        if (isset($this->updateInterceptor)) {
            if (is_string($this->updateInterceptor) && is_subclass_of($this->updateInterceptor, InterceptorAbstract::class)) {
                $this->updateInterceptor = app($this->updateInterceptor);
            }
            is_object($this->updateInterceptor) ? $this->updateInterceptor->apply($data, $obj) : null;
        }
    }


    /**
     * Run validator class in data of request.
     *
     * @param Collection $data
     * @param Model $obj
     * @return array
     */
    protected function updateValidator($data, $obj)
    {
        if (isset($this->updateValidator)) {
            if (is_string($this->updateValidator) && is_subclass_of($this->updateValidator, ValidatorAbstract::class)) {
                $this->updateValidator = app($this->updateValidator);
            }
            is_object($this->updateValidator) ? $this->updateValidator->apply($data, $obj) : null;
        }
    }

    /**
     * Run update command in the repository.
     *
     * @param Collection $data
     * @param Model $obj
     * @return bool
     */
    protected function updateSave($data, $obj)
    {
        $obj->fill($data->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}