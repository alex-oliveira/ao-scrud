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
    public function apply($config)
    {
        if (!($config instanceof ModelInterface && $config instanceof ColumnsInterface && $config instanceof DataInterface))
            return;

        $allowed = $config->columns();

        if ($config instanceof OtherColumnsInterface)
            $allowed = $allowed->merge($config->otherColumns()->all())->unique();

        if ($allowed->count() == 0)
            return;

        if ($columns = $config->data()->get('columns', false))
            $columns = $columns == '*' ? $allowed->all() : $allowed->intersect(explode(',', $columns))->all();

        if ($without = $config->data()->get('withoutColumns', false))
            $columns = $allowed->diff(explode(',', $without))->all();

        $model = $columns && count($columns) > 0
            ? $config->model()->select($columns)
            : $config->model()->select($config->columns()->all());

        //echo $model->toSql(); exit;

        $config->model($model);
    }

}