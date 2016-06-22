<?php

namespace AoScrud\Repositories\Criteria;

class RouteParamsCriteria extends ScrudRepositoryCriteria
{

    /**
     * @param \AoScrud\Repositories\Interfaces\Methods\RouteParamsInterface $rep
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($rep, $query, $data)
    {
        if ($rep->routeParams()->isEmpty())
            return $query;

        $where = $data->only($rep->routeParams()->all())->all();
        if (is_array($where) && count($where) > 0)
            return $query->where($where);

        return $query;
    }

}