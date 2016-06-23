<?php

namespace AoScrud\Repositories\Criteria;

use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\ModelInterface;
use AoScrud\Repositories\Interfaces\Methods\OrdersInterface;

class OrdersCriteria extends BaseCriteria
{

    /**
     * @param \AoScrud\Repositories\BaseRepository $rep
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