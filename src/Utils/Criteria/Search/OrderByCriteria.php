<?php

namespace AoScrud\Utils\Criteria\Search;

use AoScrud\Utils\Criteria\BaseCriteria;

class OrderByCriteria extends BaseCriteria
{

    /**
     * @param \AoScrud\Services\ScrudService $service
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data, $service)
    {
        $allowOrders = $service->getSearchOrders();

        if (empty($allowOrders))
            return $query;

        $order = $allowOrders[0];
        if (($o = $data->get('order', false)) && in_array($o, $allowOrders))
            $order = $o;

        return $query->orderBy($order, ($data->get('sort') == 'desc' ? 'desc' : 'asc'));
    }

}