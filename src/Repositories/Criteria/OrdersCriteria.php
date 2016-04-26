<?php

namespace AoScrud\Repositories\Criteria;

class OrdersCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\Interfaces\Methods\OrdersInterface $rep
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
        if ($rep->orders()->isEmpty())
            return $query;

        $order = $rep->orders()->first();
        if (($o = $data->get('order', false)) && $rep->orders()->contains($o))
            $order = $o;

        $sort = $data->get('sort') == 'desc' ? 'desc' : 'asc';
        return $query->orderBy($order, $sort)->orderBy('id', $sort);
    }

}