<?php

namespace AoScrud\Repositories\Criteria;

class ColumnsCriteria extends ScrudRepositoryCriteria
{

    /**
     * @var array
     */
    private $columns;

    /**
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if (empty($this->columns))
            return $query;

        if ($columns = $data->get('columns', false))
            $columns = array_intersect(explode(',', $columns), $this->columns);

        $query = $columns && count($columns) > 0
            ? $query->select($columns)
            : $query->select($this->columns);

        return $query;
    }

}