<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\OrdersInterface;

class OrdersCriteria extends BaseCriteria
{

    /**
     * @param mixed
     * @return mixed
     */
    public function apply($rep)
    {
        if (!($rep instanceof ModelInterface && $rep instanceof OrdersInterface && $rep instanceof DataInterface))
            return;

        if ($rep->orders()->isEmpty())
            return;

        $order = $rep->orders()->first();
        if (($field = $rep->data()->get('order', false)) && $rep->orders()->contains($field))
            $order = $field;

        $sort = $rep->data()->get('sort') == 'desc' ? 'desc' : 'asc';
        $model = $rep->model()->orderBy($order, $sort)->orderBy('id', $sort);

        //echo $model->toSql(); exit;

        $rep->model($model);
    }

}