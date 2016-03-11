<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelWithCriteria extends BaseSearchCriteria
{

    /**
     * Determine that the criteria is available only to read e search.
     *
     * @var bool
     */
    public $readonly = true;

    /**
     * @var array;
     */
    protected $allowWith;

    /**
     * @param array $allowWith
     * @param Collection $data
     */
    public function __construct(array $allowWith = [], Collection $data = null)
    {
        $this->allowWith = $allowWith;
        $this->data = is_null($data) ? collect(request()->only(['with'])) : $data;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowWith))
            return $model;

        if ($with = $this->data()->get('with', false))
            $with = array_intersect(explode(';', $with), $this->allowWith);

        if ($with && count($with) > 0)
            $model = $model->with($with);

        return $model;
    }

}