<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Checkers\CheckerAbstract;
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
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array|null $params
     * @return bool
     * @throws \Exception
     */
    public function destroy(array $params = null)
    {
        $obj = $this->destroySelect($params);

        $this->destroyChecker($obj);

        $this->tBegin();
        try {
            $status = $this->destroyFinalize($obj);
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
     * Return the object the should be destroyed.
     *
     * @param array $params
     * @return Model $obj
     */
    protected function destroySelect(array $params = null)
    {
        return $this->read($params, false);
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