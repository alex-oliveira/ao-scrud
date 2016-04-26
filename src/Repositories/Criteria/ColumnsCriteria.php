<?php

namespace AoScrud\Repositories\Criteria;

use AoScrud\Repositories\Interfaces\Methods\OtherColumnsInterface;

class ColumnsCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\Interfaces\Methods\ColumnsInterface $rep
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
        $allowed = $rep->columns();
        $rep instanceof OtherColumnsInterface ? $allowed->merge($rep->otherColumns()) : null;

        if ($allowed->count() == 0)
            return $query;

        if ($columns = $data->get('columns', false))
            $columns = $allowed->intersect(explode(',', $columns))->all();

        $query = $columns && count($columns) > 0
            ? $query->select($columns)
            : $query->select($rep->columns()->all());

        return $query;
    }

}