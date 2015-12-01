<?php

namespace AoScrud\Services\Resources\Destroy;

use AoScrud\Tools\Checkers\CheckerAbstract;
use Exception;
use Illuminate\Database\Eloquent\Model;

trait Destroy
{

    /**
     * The validator class to destroy in repository.
     *
     * @var CheckerAbstract
     */
    protected $destroyChecker;

    //------------------------------------------------------------------------------------------------------------------
    // MASTERS //-------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array|null $keys
     * @return bool
     * @throws Exception
     */
    public function destroy(array $keys = null)
    {
        $obj = $this->destroyRead($keys);

        $this->destroyChecker($obj);

        $this->tBegin();
        try {
            $status = $this->destroyFinalize($obj);
        } catch (Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $status;
    }

    /**
     * Return the object the should be destroyed.
     *
     * @param array $keys
     * @return Model $obj
     */
    protected function destroyRead(array $keys = null)
    {
        return $this->read($keys);
    }

    /**
     * <description>
     *
     * @param Model $obj
     * @return bool
     */
    protected function destroyChecker($obj)
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
     * @return bool
     */
    protected function destroyFinalize($obj)
    {
        return $obj->delete();
    }

}