<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * The interceptor class to update in the repository.
     *
     * @var SaveInterceptor[]
     */
    protected $updateInterceptors = [];

    /**
     * The allow fields to update.
     *
     * @var array
     */
    protected $updateFillable = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update in the repository.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function update(array $data)
    {
        $data = collect($data);
        $obj = $this->updateSelect($data);
        $this->updatePrepare($data, $obj);

        $this->tBegin();
        try {
            $status = $this->updateExecute($data, $obj);
        } catch (\Exception $e) {
            $this->tRollBack();
            $this->modelReset();
            throw $e;
        }
        $this->tCommit();
        $this->modelReset();

        // DISPATCH EVENT

        return $status;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the object the should be updated.
     *
     * @param Collection $data
     * @return Model $obj
     */
    protected function updateSelect(Collection $data)
    {
        return $this->read($data->all());
    }

    /**
     * Run all preparations before update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updatePrepare(Collection $data, Model $obj)
    {
        $this->updateInterceptors($data, $obj);
        $this->updateValidate($data, $obj);
    }

    /**
     * Apply interceptors to update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updateInterceptors(Collection $data, Model $obj)
    {
        foreach ($this->updateInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, BaseInterceptor::class))
                $this->updateInterceptors[$key] = $interceptor = app($interceptor);

            if (is_object($interceptor) && $interceptor instanceof BaseInterceptor)
                $interceptor->apply($this, $data, $obj);
        }
    }

    /**
     * Apply validation to update.
     *
     * @param Collection $data
     * @param Model $obj
     * @return array
     */
    protected function updateValidate(Collection $data, Model $obj)
    {
        validate($data->all(), $this->updateRules($data, $obj));
    }

    /**
     * Return the validation rules to update.
     *
     * @param Collection $data
     * @param Model $obj
     * @return array
     */
    protected function updateRules(Collection $data, Model $obj)
    {
        return [];
    }

    /**
     * Define the allow fields to update.
     *
     * @return array
     */
    protected function updateFillable()
    {
        return $this->updateFillable;
    }

    /**
     * Run update command in the repository.
     *
     * @param Collection $data
     * @param Model $obj
     * @return bool
     */
    protected function updateExecute(Collection $data, Model $obj)
    {
        $obj->fill($data->only($this->updateFillable())->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}