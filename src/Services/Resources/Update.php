<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\SaveInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * The allow fields to update.
     *
     * @var array
     */
    protected $updateFillable = [];

    /**
     * The interceptor class to update in the repository.
     *
     * @var SaveInterceptor[]
     */
    protected $updateInterceptors = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update in the repository.
     *
     * @param Collection $data
     * @param Collection $keys
     * @return bool
     * @throws \Exception
     */
    public function update(Collection $data, Collection $keys)
    {
        $obj = $this->updateSelect($keys);

        $this->updatePrepare($data, $obj);

        $this->tBegin();
        try {
            $status = $this->updateExecute($data, $obj);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $status;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the object the should be updated.
     *
     * @param Collection $keys
     * @return Model $obj
     */
    protected function updateSelect(Collection $keys)
    {
        return $this->read($keys, false);
    }

    /**
     * Run all preparations before update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updatePrepare(Collection $data, Model $obj)
    {
        foreach ($this->updateInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, SaveInterceptor::class)) {
                $this->updateInterceptors[$key] = $interceptor = app($interceptor);
            }
            is_object($interceptor) && $interceptor instanceof SaveInterceptor ? $interceptor->apply($data, $obj) : null;
        }
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