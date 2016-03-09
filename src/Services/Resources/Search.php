<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelOrderCriteria;
use AoScrud\Utils\Criteria\ModelRulesCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use Illuminate\Database\Eloquent\Model;

trait Search
{

    /**
     * The search's criteria.
     *
     * @var array
     */
    protected $searchCriteria = [];

    /**
     * The search's rules.
     *
     * @var array
     */
    protected $searchRules = [];

    /**
     * The columns' names allowed.
     *
     * @var array
     */
    protected $searchColumns = [];

    /**
     * The columns' names allowed to order.
     *
     * @var array
     */
    protected $searchOrders = [];

    /**
     * The withs' names allowed.
     *
     * @var array
     */
    protected $searchWith = [];

    /**
     * The search's limit per page.
     *
     * @var int
     */
    protected $searchLimit = 24;

    /**
     * The search's max limit per page.
     *
     * @var int
     */
    protected $searchLimitMax = 50;

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read in the repository.
     *
     * @return Model[]|null
     * @throws \Exception
     */
    public function search()
    {
        $this->searchCriteria();

        try {
            $result = $this->searchExecute();
        } catch (\Exception $e) {
            throw $e;
        }

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // CUSTOM METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Add search criteria in the repository.
     */
    protected function searchCriteria()
    {
        foreach ($this->searchCriteria as $criteria) {
            $this->rep->pushCriteria($criteria);
        }

        $this->rep->pushCriteria(new RouteParamsCriteria());
        $this->rep->pushCriteria(new ModelRulesCriteria($this->getSearchRules()));
        $this->rep->pushCriteria(new ModelColumnsCriteria($this->getSearchColumns()));
        $this->rep->pushCriteria(new ModelWithCriteria($this->getSearchWith()));
        $this->rep->pushCriteria(new ModelOrderCriteria($this->getSearchOrders()));
    }

    /**
     * Run find command in the repository.
     *
     * @return Model[]|null
     */
    protected function searchExecute()
    {
        return $this->rep->paginate($this->searchLimit());
    }

    /**
     * Return the search's limit required.
     * @return int|string
     */
    protected function searchLimit()
    {
        $limit = request()->get('limit', false);
        if ($limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->searchLimitMax) {
            $this->searchLimit = $limit;
        }
        return $this->searchLimit;
    }

    //------------------------------------------------------------------------------------------------------------------
    // GETS & SETS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the search's rules.
     *
     * @return array
     */
    public function getSearchRules()
    {
        return $this->searchRules;
    }

    /**
     * Return the columns' names allowed.
     *
     * @return array
     */
    public function getSearchColumns()
    {
        return $this->searchColumns;
    }

    /**
     * Return the columns' names allowed to order.
     *
     * @return array
     */
    public function getSearchOrders()
    {
        return $this->searchOrders;
    }

    /**
     * Return the withs' names allowed.
     *
     * @return array
     */
    public function getSearchWith()
    {
        return $this->searchWith;
    }

    /**
     * Return the search's limit per page.
     *
     * @return array
     */
    public function getSearchLimit()
    {
        return $this->searchLimit;
    }

    /**
     * Return the search's max limit per page.
     *
     * @return array
     */
    public function getSearchLimitMax()
    {
        return $this->searchLimitMax;
    }

}