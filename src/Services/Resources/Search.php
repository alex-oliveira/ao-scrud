<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\BaseCriteria;
use AoScrud\Utils\Criteria\BaseSearchCriteria;
use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelOrderCriteria;
use AoScrud\Utils\Criteria\ModelRulesCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait Search
{

    /**
     * The object to search.
     *
     * @var Model/Relation
     */
    protected $searchModel;

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
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        $data = collect($data);

        $this->searchModel($data);
        $this->searchPrepare($data);
        $result = $this->searchExecute();

        // DISPATCH EVENT

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the model to search.
     *
     * @param Collection $data
     */
    protected function searchModel(Collection $data)
    {
        $this->searchModel = $this->model();
    }

    /**
     * Run all preparations before search.
     *
     * @param Collection $data
     */
    protected function searchPrepare(Collection $data)
    {
        $this->searchCriteria($data);
        $this->searchLimit($data);
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     */
    protected function searchCriteria(Collection $data)
    {
        foreach ($this->searchCriteria as $key => $criteria) {
            if (is_string($criteria) && is_subclass_of($criteria, BaseCriteria::class))
                $this->searchCriteria[$key] = $criteria = app($criteria);

            if ($criteria instanceof BaseCriteria)
                $this->searchModel = $criteria->apply($this->searchModel, $data, $this);
        }

//        foreach ($this->searchCriteria as $criteria) {
//            if ($criteria instanceof BaseSearchCriteria) {
//                $criteria->setData($data);
//                $this->rep->pushCriteria($criteria);
//            }
//        }

        //
        //$this->rep->pushCriteria(new RouteParamsCriteria($data));
        //$this->rep->pushCriteria(new ModelRulesCriteria($this->getSearchRules(), $data));
        //$this->rep->pushCriteria(new ModelColumnsCriteria($this->getSearchColumns(), $data));
        //$this->rep->pushCriteria(new ModelWithCriteria($this->getSearchWith(), $data));
        //$this->rep->pushCriteria(new ModelOrderCriteria($this->getSearchOrders(), $data));
    }

    /**
     * Return the search's limit required.
     *
     * @param Collection $data
     */
    protected function searchLimit(Collection $data)
    {
        $limit = $data->get('limit', false);
        if ($limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->searchLimitMax)
            $this->searchLimit = $limit;
    }

    /**
     * Run find command in the repository.
     *
     * @return LengthAwarePaginator
     */
    protected function searchExecute()
    {
        return $this->searchModel->paginate($this->searchLimit);
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
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