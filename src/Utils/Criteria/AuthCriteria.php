<?php

namespace AoScrud\Utils\Criteria;

class AuthCriteria extends BaseCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @param \AoScrud\Services\ScrudService $service
     * @return mixed
     */
    public function apply($query, $data, $service)
    {
        return $query->where('user_id', USER_ID);
    }

}