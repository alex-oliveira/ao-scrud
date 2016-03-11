<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelColumnsCriteria extends BaseSearchCriteria
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
    protected $allowColumns;

    /**
     * @param array $allowColumns
     * @param Collection $data
     */
    public function __construct(array $allowColumns = [], Collection $data = null)
    {
        $this->allowColumns = $allowColumns;
        $this->data = is_null($data) ? collect(request()->only(['columns'])) : $data;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowColumns))
            return $model;

        if ($columns = $this->data()->get('columns', false))
            $columns = array_intersect(explode(';', $columns), $this->allowColumns);

        if ($columns && count($columns) > 0)
            $model = $model->select($columns);
        else
            $model = $model->select($this->allowColumns);

        return $model;
    }

}