<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

class RouteParamsCriteria extends BaseSearchCriteria
{

    /**
     * @param Collection $data
     */
    public function __construct(Collection $data = null)
    {
        $this->data = is_null($data) ? collect(request()->route()->parameters()) : $data;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where($this->data()->only(array_keys(request()->route()->parameters()))->all());
    }

}