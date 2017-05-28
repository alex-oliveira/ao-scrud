<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Configs\Interfaces\IData;
use AoScrud\Configs\Interfaces\IModel;
use AoScrud\Configs\Interfaces\IOrders;

class OrdersCriteria extends BaseCriteria
{

    /**
     * @param IData|IModel|IOrders $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof IOrders && $config instanceof IData && $config instanceof IModel))
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