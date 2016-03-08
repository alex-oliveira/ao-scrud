<?php

namespace AoScrud\Services\Resources\Show;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Show
{

    /**
     * The show's criteria.
     *
     * @var array
     */
    protected $showCriteria = [];

    /**
     * The columns' names allowed.
     *
     * @var array
     */
    protected $showColumns = [];

    /**
     * The withs's names allowed.
     *
     * @var array
     */
    protected $showWith = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to show in the repository.
     *
     * @param array|null $params
     * @param bool $onlyRead
     * @return Model|null
     * @throws Exception
     */
    public function show(array $params = null, $onlyRead = true)
    {
        $this->showCriteria($onlyRead);

        try {
            $obj = $this->showExecute($params);
        } catch (Exception $e) {
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
     * Add show criteria in the repository.
     *
     * @param bool $onlyRead
     */
    protected function showCriteria($onlyRead = true)
    {
        $this->showCriteria[] = new ModelColumnsCriteria($this->getShowColumns());
        $this->showCriteria[] = new ModelWithCriteria($this->getShowWith());

        if ($onlyRead) {
            foreach ($this->showCriteria as $criteria)
                $this->rep->pushCriteria($criteria);
        } else {
            foreach ($this->showCriteria as $criteria) {
                if (isset($criteria->onlyRead) && $criteria->onlyRead == true) {
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
    protected function showExecute(array $params = null)
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
    public function getShowColumns()
    {
        return $this->showColumns;
    }

    /**
     * Return the withs' names allowed.
     *
     * @return array
     */
    public function getShowWith()
    {
        return $this->showWith;
    }

}