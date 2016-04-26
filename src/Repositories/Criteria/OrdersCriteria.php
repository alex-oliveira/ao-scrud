<?php

namespace AoScrud\Repositories\Criteria;

class OrdersCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\ScrudRepository
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
//        if (empty($this->allowOrders))
//            return $query;
//
//        $order = $this->allowOrders[0];
//        if (($o = $data->get('order', false)) && in_array($o, $this->allowOrders))
//            $order = $o;
//
//        $sort = $data->get('sort') == 'desc' ? 'desc' : 'asc';
//        return $query->orderBy($order, $sort)->orderBy('id', $sort);

        return $query;
    }

}