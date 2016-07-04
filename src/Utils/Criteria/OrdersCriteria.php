<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\OrdersInterface;

class OrdersCriteria extends BaseCriteria
{

    /**
     * @param OrdersInterface|DataInterface|ModelInterface $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof OrdersInterface && $config instanceof DataInterface && $config instanceof ModelInterface))
            return;

        if ($config->orders()->isEmpty())
            return;

        $order = $config->orders()->first();
        if (($field = $config->data()->get('order', false)) && $config->orders()->contains($field))
            $order = $field;

        $sort = $config->data()->get('sort') == 'desc' ? 'desc' : 'asc';
        $model = $config->model()->orderBy($order, $sort)->orderBy('id', $sort);

        //echo $model->toSql(); exit;

        $config->model($model);
    }

}