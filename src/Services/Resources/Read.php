<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Criteria\ModelColumnsCriteria;
use AoScrud\Services\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Read
{

    /**
     * The read's criteria.
     *
     * @var array
     */
    protected $readCriteria = [];

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
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read in the repository.
     *
     * @param array|null $params
     * @param bool $readonly
     * @return Model|null
     * @throws Exception
     */
    public function read(array $params = null, $readonly = true)
    {
        $this->readCriteria($readonly);

        try {
            $obj = $this->readExecute($params);
        } catch (\Exception $e) {
            throw $e;
        }

        if (is_null($obj)) {
            throw new ModelNotFoundException();
        }

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // CUSTOMS METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Add read criteria in the repository.
     *
     * @param bool $readonly
     */
    protected function readCriteria($readonly = true)
    {
        $this->readCriteria[] = new ModelColumnsCriteria($this->getReadColumns());
        $this->readCriteria[] = new ModelWithCriteria($this->getReadWith());

        if ($readonly) {
            foreach ($this->readCriteria as $criteria)
                $this->rep->pushCriteria($criteria);
        } else {
            foreach ($this->readCriteria as $criteria) {
                if (isset($criteria->readonly) && $criteria->readonly == true) {
                    continue;
                }
                $this->rep->pushCriteria($criteria);
            }
        }
    }

    /**
     * Run find command in the repository.
     *
     * @param array|null $params
     * @return Model|null
     */
    protected function readExecute(array $params = null)
    {
        return $this->rep->findWhere((is_null($params) ? request()->route()->parameters() : $params))->first();
    }

    //------------------------------------------------------------------------------------------------------------------
    // GETS & SETS
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