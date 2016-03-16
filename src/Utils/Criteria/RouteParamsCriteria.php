<?php

namespace AoScrud\Utils\Criteria;

class RouteParamsCriteria extends BaseCriteria
{

    /**
     * @var array
     */
    private $routeKeys;

    /**
     * @param array $routeKeys
     */
    public function __construct(array $routeKeys)
    {
        $this->routeKeys = $routeKeys;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if (empty($this->routeKeys))
            return $query;

        $where = $data->only($this->routeKeys)->all();
        if (is_array($where) && count($where) > 0)
            return $query->where($where);

        return $query;
    }

}