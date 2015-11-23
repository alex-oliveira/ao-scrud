<?php

namespace AoScrud\Tools\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class RouteParamsCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where(request()->route()->parameters());
    }

}