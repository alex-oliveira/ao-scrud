<?php

namespace AoScrud\Utils\Criteria;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @var array
     */
    private $columns;

    /**
     * @var array
     */
    private $allowColumns;

    /**
     * @param array $columns
     * @param array $allowColumns
     */
    public function __construct(array $columns, array $allowColumns)
    {
        $this->columns = $columns;
        $this->allowColumns = empty($allowColumns) ? $columns : $allowColumns;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if (empty($this->allowColumns))
            return $query;

        if ($columns = $data->get('columns', false))
            $columns = array_intersect(explode(',', $columns), $this->allowColumns);

        $query = $columns && count($columns) > 0
            ? $query->select($columns)
            : $query->select($this->columns);

        return $query;
    }

}