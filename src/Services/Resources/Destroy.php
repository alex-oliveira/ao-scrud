<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Destroy
{

    /**
     * The interceptor class to registry in the repository.
     *
     * @var BaseInterceptor[]
     */
    protected $destroyInterceptors = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function destroy(array $data)
    {
        $data = collect($data);
        $obj = $this->destroySelect($data);

        $this->destroyPrepare($data, $obj);

        $this->tBegin();
        try {
            $status = $this->destroyExecute($obj);
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
     * Return the object the should be destroyed.
     *
     * @param Collection $data
     * @return Model $obj
     */
    protected function destroySelect(Collection $data)
    {
        return $this->read($data->all());
    }

    /**
     * Run all preparations before destroy.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function destroyPrepare(Collection $data, Model $obj)
    {
        $this->destroyInterceptors($data, $obj);
    }

    /**
     * Apply interceptors to destroy.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function destroyInterceptors(Collection $data, Model $obj)
    {
        foreach ($this->destroyInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, BaseInterceptor::class))
                $this->destroyInterceptors[$key] = $interceptor = app($interceptor);

            if (is_object($interceptor) && $interceptor instanceof BaseInterceptor)
                $interceptor->apply($this, $data, $obj);
        }
    }

    /**
     * Run delete command in the repository.
     *
     * @param Model $obj
     * @return bool|null
     */
    protected function destroyExecute(Model $obj)
    {
        return $obj->delete();
    }

}