<?php

namespace AoScrud\Utils\Criteria;

class OrderByCriteria extends BaseCriteria
{

    /**
     * @var array
     */
    private $allowOrders;

    /**
     * @param array $allowOrders
     */
    public function __construct(array $allowOrders)
    {
        $this->allowOrders = $allowOrders;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if (empty($this->allowOrders))
            return $query;

        $order = $this->allowOrders[0];
        if (($o = $data->get('order', false)) && in_array($o, $this->allowOrders))
            $order = $o;

        return $query->orderBy($order, ($data->get('sort') == 'desc' ? 'desc' : 'asc'));
    }

}