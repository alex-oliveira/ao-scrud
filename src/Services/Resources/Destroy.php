<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\DestroyInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Destroy
{

    /**
     * The interceptor class to registry in the repository.
     *
     * @var DestroyInterceptor[]
     */
    protected $destroyInterceptors = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param Collection $data
     * @return bool
     * @throws \Exception
     */
    public function destroy(Collection $data)
    {
        $obj = $this->destroySelect($data);

        $this->destroyPrepare($obj);

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
        return $this->read(collect($data->all()), false);
    }

    /**
     * Run all preparations before destroy.
     *
     * @param Model $obj
     * @return bool
     */
    protected function destroyPrepare(Model $obj)
    {
        foreach ($this->destroyInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, DestroyInterceptor::class))
                $this->destroyInterceptors[$key] = $interceptor = app($interceptor);

            is_object($interceptor) && $interceptor instanceof DestroyInterceptor ? $interceptor->apply($obj) : null;
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