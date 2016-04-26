<?php

namespace AoScrud\Repositories\Criteria;

class RouteParamsCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\ScrudRepository
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
//        if (empty($this->routeKeys))
//            return $query;
//
//        $where = $data->only($this->routeKeys)->all();
//        if (is_array($where) && count($where) > 0)
//            return $query->where($where);

        return $query;
    }

}