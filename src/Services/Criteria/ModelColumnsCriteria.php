<?php

namespace AoScrud\Services\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelColumnsCriteria implements CriteriaInterface
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
     */
    public function __construct(array $allowColumns = [])
    {
        $this->allowColumns = $allowColumns;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->allowColumns)) {
            return $model;
        }

        if ($columns = request()->get('columns', false)) {
            $columns = array_intersect(explode(';', $columns), $this->allowColumns);
        }

        if ($columns && count($columns) > 0) {
            $model = $model->select($columns);
        } else {
            $model = $model->select($this->allowColumns);
        }

        return $model;
    }

}