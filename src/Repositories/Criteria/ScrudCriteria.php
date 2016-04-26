<?php

namespace AoScrud\Repositories\Criteria;

abstract class ScrudRepositoryCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    abstract public function apply($rep, $query, $data);

}