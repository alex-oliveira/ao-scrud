<?php

namespace AoScrud\Tools\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelOrderCriteria implements CriteriaInterface
{

    /**
     * @var array;
     */
    protected $allowOrders;

    /**
     * @param array $allowOrders
     */
    public function __construct(array $allowOrders = [])
    {
        $this->allowOrders = $allowOrders;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowOrders)) {
            return $model;
        }

        if (($order = request()->get('order', false)) && in_array($order, $this->allowOrders)) {
            $model = $model->orderBy($order, (request()->get('sort') == 'desc' ? 'desc' : 'asc'));
        }

        return $model;
    }

}