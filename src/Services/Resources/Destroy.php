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
    protected $createInterceptors = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param Collection $keys
     * @return bool
     * @throws \Exception
     */
    public function destroy(Collection $keys = null)
    {
//        $obj = $this->destroySelect($keys);
//
//        $this->destroyPrepare($obj);
//
//        $this->tBegin();
//        try {
//            $status = $this->destroyExecute($obj);
//        } catch (\Exception $e) {
//            $this->tRollBack();
//            throw $e;
//        }
//        $this->tCommit();
//
//        return $status;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the object the should be destroyed.
     *
     * @param Collection $keys
     * @return Model $obj
     */
    protected function destroySelect(Collection $keys = null)
    {
        return $this->read($keys, false);
    }

    /**
     * Run all preparations before destroy.
     *
     * @param Model $obj
     * @return bool
     */
    protected function destroyPrepare(Model $obj)
    {
        if (isset($this->destroyChecker)) {
            if (is_string($this->destroyChecker) && is_subclass_of($this->destroyChecker, CheckerAbstract::class)) {
                $this->destroyChecker = app($this->destroyChecker);
            }
            is_object($this->destroyChecker) ? $this->destroyChecker->check($obj) : null;
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