<?php

namespace AoScrud\Utils\Criteria\Search;

use AoScrud\Utils\Criteria\BaseCriteria;

class ColumnsCriteria extends BaseCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @param \AoScrud\Services\ScrudService $service
     * @return mixed
     */
    public function apply($query, $data, $service)
    {
        $allowColumns = $service->getSearchColumns();

        if (empty($allowColumns))
            return $query;

        if ($columns = $data->get('columns', false))
            $columns = array_intersect(explode(',', $columns), $allowColumns);

        $query = $columns && count($columns) > 0
            ? $query->select($columns)
            : $query->select($allowColumns);

        return $query;
    }

}