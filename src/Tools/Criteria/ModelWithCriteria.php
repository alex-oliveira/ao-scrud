<?php

namespace AoScrud\Tools\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelWithCriteria implements CriteriaInterface
{

    /**
     * @var array;
     */
    protected $allowWith;

    /**
     * @param array $allowWith
     */
    public function __construct(array $allowWith = [])
    {
        $this->allowWith = $allowWith;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowWith)) {
            return $model;
        }

        if ($with = request()->get('with', false)) {
            $with = array_intersect(explode(';', $with), $this->allowWith);
        }

        if ($with && count($with) > 0) {
            $model = $model->with($with);
        }

        return $model;
    }

}