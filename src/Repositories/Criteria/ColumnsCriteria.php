<?php

namespace AoScrud\Repositories\Criteria;

class ColumnsCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\ScrudRepository
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
        if (empty($this->columns))
            return $query;

        if ($columns = $data->get('columns', false))
            $columns = array_intersect(explode(',', $columns), $this->columns);

        $query = $columns && count($columns) > 0
            ? $query->select($columns)
            : $query->select($rep->columns());

        return $query;
    }

}