<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\OtherColumnsInterface;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @param mixed
     * @return mixed
     */
    public function apply($rep)
    {
        if (!($rep instanceof ModelInterface && $rep instanceof ColumnsInterface && $rep instanceof DataInterface))
            return;

        $allowed = $rep->columns();

        if ($rep instanceof OtherColumnsInterface)
            $allowed = $allowed->merge($rep->otherColumns()->all())->unique();

        if ($allowed->count() == 0)
            return;

        if ($columns = $rep->data()->get('columns', false))
            $columns = $allowed->intersect(explode(',', $columns))->all();

        $model = $columns && count($columns) > 0
            ? $rep->model()->select($columns)
            : $rep->model()->select($rep->columns()->all());

        //echo $model->toSql(); exit;

        $rep->model($model);
    }

}