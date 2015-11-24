<?php

namespace AoScrud\Services\Resources\Search;

use AoScrud\Tools\Criteria\ModelColumnsCriteria;
use AoScrud\Tools\Criteria\ModelOrderCriteria;
use AoScrud\Tools\Criteria\ModelRulesCriteria;
use AoScrud\Tools\Criteria\ModelWithCriteria;
use AoScrud\Tools\Criteria\RouteParamsCriteria;

trait Search
{

    protected $searchRules = [];
    protected $searchColumns = [];
    protected $searchOrders = [];
    protected $searchWith = [];
    protected $searchLimit = 24;
    protected $searchLimitMax = 50;

    //------------------------------------------------------------------------------------------------------------------

    public function search()
    {
        $this->searchCustom();

        try {
            $result = $this->searchExecute();
        } catch (\Exception $e) {
            throw new \Exception('Falha inesperada ao tentar realizar a pesquisa.', 500, $e);
        }

        return $result;
    }

    protected function searchLimit()
    {
        $limit = request()->get('limit', false);
        if ($limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->searchLimitMax) {
            $this->searchLimit = $limit;
        }
        return $this->searchLimit;
    }

    protected function searchExecute()
    {
        return $this->rep->paginate($this->searchLimit());
    }

    protected function searchCustom()
    {
        $this->rep->pushCriteria(new RouteParamsCriteria());
        $this->rep->pushCriteria(new ModelRulesCriteria($this->getSearchRules()));
        $this->rep->pushCriteria(new ModelColumnsCriteria($this->getSearchColumns()));
        $this->rep->pushCriteria(new ModelWithCriteria($this->getSearchWith()));
        $this->rep->pushCriteria(new ModelOrderCriteria($this->getSearchOrders()));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function getSearchRules()
    {
        return $this->searchRules;
    }

    public function getSearchColumns()
    {
        return $this->searchColumns;
    }

    public function getSearchOrders()
    {
        return $this->searchOrders;
    }

    public function getSearchWith()
    {
        return $this->searchWith;
    }

}