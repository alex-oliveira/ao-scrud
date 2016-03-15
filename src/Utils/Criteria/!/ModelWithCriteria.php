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

        $approved = [];

        $withs = explode(';', $this->data()->get('with', ''));
        foreach ($withs as $with) {
            $parts = explode(':', $with);

            if (!array_key_exists($parts[0], $this->allowWith))
                continue;

            $columns = $this->allowWith[$parts[0]];

            if (isset($parts[1]) && strlen($parts[1]) > 0) {
                $custom = array_intersect(explode(',', $parts[1]), $this->allowWith[$parts[0]]);
                count($custom) > 0 ? $columns = $custom : null;
            }

            $approved[$parts[0]] = function ($query) use ($columns) {
                $query->select($columns);
            };
        }

        if (count($approved) > 0)
            $model = $model->with($approved);

        return $model;
    }

}