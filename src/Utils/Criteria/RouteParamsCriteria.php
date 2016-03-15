<?php

namespace AoScrud\Utils\Criteria;

class RouteParamsCriteria extends BaseCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @param \AoScrud\Services\ScrudService $service
     * @return mixed
     */
    public function apply($query, $data, $service)
    {
        return $query->where($data->only(array_keys(request()->route()->parameters()))->all());
    }

}