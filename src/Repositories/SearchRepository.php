<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Criteria\ColumnsCriteria;
use AoScrud\Repositories\Criteria\OrdersCriteria;
use AoScrud\Repositories\Criteria\RouteParamsCriteria;
use AoScrud\Repositories\Criteria\RulesCriteria;
use AoScrud\Repositories\Criteria\ScrudRepositoryCriteria;
use AoScrud\Repositories\Criteria\WithCriteria;
use AoScrud\Repositories\Interfaces\Repositories\SearchRepositoryInterface;
use AoScrud\Repositories\Traits\Columns;
use AoScrud\Repositories\Traits\Criteria;
use AoScrud\Repositories\Traits\Limit;
use AoScrud\Repositories\Traits\Orders;
use AoScrud\Repositories\Traits\OtherColumns;
use AoScrud\Repositories\Traits\RouteParams;
use AoScrud\Repositories\Traits\Rules;
use AoScrud\Repositories\Traits\Total;
use AoScrud\Repositories\Traits\With;
use Illuminate\Support\Collection;

class SearchRepository extends BaseRepository implements SearchRepositoryInterface
{

    use Columns, Criteria, Limit, Orders, OtherColumns, RouteParams, Rules, Total, With;

    public function __construct()
    {
        $this->criteria()->push(RouteParamsCriteria::class);
        $this->criteria()->push(RulesCriteria::class);
        $this->criteria()->push(ColumnsCriteria::class);
        $this->criteria()->push(WithCriteria::class);
        $this->criteria()->push(OrdersCriteria::class);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function run(array $data)
    {
        $data = collect($data);

        $model = $this->makeModel();
        $model = $this->makeCriteria($model, $data);

        $result = $this->total()
            ? $model->paginate($this->makeLimit($data))
            : $model->paginate($this->makeLimit($data));

        # TODO: OnReady or Event

        return $result;
    }

    /**
     * @param mixed $model
     * @param Collection $data
     * @return mixed
     */
    protected function makeCriteria($model, Collection $data)
    {
        foreach ($this->criteria()->all() as $key => $criteria) {
            if (is_string($criteria) && is_subclass_of($criteria, ScrudRepositoryCriteria::class))
                $this->criteria->put($key, ($criteria = app($criteria)));

            if ($criteria instanceof ScrudRepositoryCriteria)
                $model = $criteria->apply($this, $model, $data);
        }
        return $model;
    }

    /**
     * @param Collection $data
     * @return int
     */
    protected function makeLimit(Collection $data)
    {
        $limit = $data->get('limit', false);
        $limit = $limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->limit()
            ? $limit
            : 24;

        return $limit;
    }

}