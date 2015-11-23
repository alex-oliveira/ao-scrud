<?php

namespace AoScrud\Services\Resources\Search;

use AoScrud\Tools\Criteria\RouteParamsCriteria;

trait Search
{

    public function search($data = null, $columns = null, $orders = null, $limit = null)
    {
        $data = collect((is_null($data) ? self::data() : $data));

        //$this->searchCriteria($params);
        //$this->searchColumns($columns);
        //$this->searchOrders($orders);
        //$this->searchLimit($limit);

        try {
            $this->rep->pushCriteria(new RouteParamsCriteria());
            $result = $this->rep->paginate();
        } catch (\Exception $e) {
            throw new \Exception('Falha inesperada ao tentar realizar a pesquisa.', 500, $e);
        }

        return $result;
    }

}