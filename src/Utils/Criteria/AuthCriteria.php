<?php

namespace AoScrud\Utils\Criteria;

class AuthCriteria extends BaseCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        return $query->where('user_id', USER_ID);
    }

}