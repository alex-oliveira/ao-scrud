<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class MyCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('user_id', '=', Auth::user()->id);
    }

}