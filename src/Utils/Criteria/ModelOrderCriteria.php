<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelOrderCriteria extends BaseSearchCriteria
{

    /**
     * @var array;
     */
    protected $allowOrders;

    /**
     * @param array $allowOrders
     * @param Collection $data
     */
    public function __construct(array $allowOrders = [], Collection $data = null)
    {
        $this->allowOrders = $allowOrders;
        $this->data = is_null($data) ? collect(request()->only(['order', 'sort'])) : $data;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowOrders))
            return $model;

        if (($order = $this->data()->get('order', false)) && in_array($order, $this->allowOrders))
            $model = $model->orderBy($order, ($this->data()->get('sort') == 'desc' ? 'desc' : 'asc'));

        return $model;
    }

}