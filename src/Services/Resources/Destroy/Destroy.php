<?php

namespace AoScrud\Services\Resources\Destroy;

use AoScrud\Tools\Validators\ValidatorDestroyAbstract;
use Exception;
use Illuminate\Database\Eloquent\Model;

trait Destroy
{

    /**
     * The validator class to destroy in repository.
     *
     * @var ValidatorDestroyAbstract
     */
    protected $destroyValidator;

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

        $this->destroyValidator($obj);

        $this->tBegin();
        try {
            $status = $this->destroyFinalize($obj);
        } catch (Exception $e) {
            $this->tRollBack();
            throw new Exception('falha ao tentar excluir', 500, $e);
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
     * Run delete command in the repository.
     *
     * @param Model $obj
     * @return bool
     */
    protected function destroyValidator($obj)
    {
        if (isset($this->destroyValidator)) {
            if (is_string($this->destroyValidator) && is_subclass_of($this->destroyValidator, ValidatorDestroyAbstract::class)) {
                $this->destroyValidator = app($this->destroyValidator);
            }
            is_object($this->destroyValidator) ? $this->destroyValidator->verify($obj) : null;
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