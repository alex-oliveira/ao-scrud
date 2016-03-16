<?php

namespace AoScrud\Utils\Criteria;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @var array
     */
    private $allowColumns;

    /**
     * @param array $allowColumns
     */
    public function __construct(array $allowColumns)
    {
        $this->allowColumns = $allowColumns;
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
            : $query->select($this->allowColumns);

        return $query;
    }

}