<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Configs\Interfaces\IColumns;
use AoScrud\Configs\Interfaces\IData;
use AoScrud\Configs\Interfaces\IModel;
use AoScrud\Configs\Interfaces\IOtherColumns;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @param IColumns|IData|IModel $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof IColumns && $config instanceof IData && $config instanceof IModel))
            return;

        $allowed = $config->columns();

        if ($config instanceof IOtherColumns)
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