<?php

namespace AoScrud\Repositories\Criteria;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\ModelInterface;
use AoScrud\Repositories\Interfaces\Methods\OtherColumnsInterface;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @param \AoScrud\Repositories\BaseRepository $rep
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