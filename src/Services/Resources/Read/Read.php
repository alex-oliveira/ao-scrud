<?php

namespace AoScrud\Services\Resources\Read;

use AoScrud\Tools\Criteria\ModelColumnsCriteria;
use AoScrud\Tools\Criteria\ModelWithCriteria;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Read
{
    /**
     * The columns' names allowed.
     *
     * @var array
     */
    protected $readColumns = [];

    /**
     * The withs's names allowed.
     *
     * @var array
     */
    protected $readWith = [];

    //------------------------------------------------------------------------------------------------------------------
    // MASTERS //-------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read in the repository.
     *
     * @param array|null $keys
     * @return Model|null
     * @throws Exception
     */
    public function read(array $keys = null)
    {
        $this->readCriteria();

        try {
            $obj = $this->readExecute($keys);
        } catch (Exception $e) {
            throw new Exception('Falha inesperada ao tentar recuperar o registro.', 500, $e);
        }

        if (is_null($obj)) {
            throw new ModelNotFoundException();
        }

        return $obj;
    }

    /**
     * Add read criteria in the repository.
     */
    protected function readCriteria()
    {
        //$this->rep->pushCriteria(new RouteParamsCriteria());
        $this->rep->pushCriteria(new ModelColumnsCriteria($this->getReadColumns()));
        $this->rep->pushCriteria(new ModelWithCriteria($this->getReadWith()));
    }

    /**
     * Run find command in the repository.
     *
     * @param array|null $keys
     * @return Model|null
     */
    protected function readExecute(array $keys = null)
    {
        return $this->rep->findWhere((is_null($keys) ? request()->route()->parameters() : $keys))->first();
        //return $this->rep->find(params()->get('id'));
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARIES //---------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the columns' names allowed.
     *
     * @return array
     */
    public function getReadColumns()
    {
        return $this->readColumns;
    }

    /**
     * Return the withs' names allowed.
     *
     * @return array
     */
    public function getReadWith()
    {
        return $this->readWith;
    }

}