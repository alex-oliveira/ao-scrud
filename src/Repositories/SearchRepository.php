<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Criteria\ColumnsCriteria;
use AoScrud\Repositories\Criteria\OrdersCriteria;
use AoScrud\Repositories\Criteria\RouteParamsCriteria;
use AoScrud\Repositories\Criteria\RulesCriteria;
use AoScrud\Repositories\Criteria\WithCriteria;
use AoScrud\Repositories\Interfaces\Repositories\SearchRepositoryInterface;
use AoScrud\Repositories\Traits\Columns;
use AoScrud\Repositories\Traits\Criteria;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Keys;
use AoScrud\Repositories\Traits\Limit;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnPrepare;
use AoScrud\Repositories\Traits\OnPrepareEnd;
use AoScrud\Repositories\Traits\OnPrepareError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\Orders;
use AoScrud\Repositories\Traits\OtherColumns;
use AoScrud\Repositories\Traits\Rules;
use AoScrud\Repositories\Traits\Total;
use AoScrud\Repositories\Traits\With;

class SearchRepository extends BaseRepository implements SearchRepositoryInterface
{

    use Data, Keys, Columns, OtherColumns, Rules, Orders, Criteria, With, Total, Limit, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    public function __construct()
    {
        $this->criteria()->push(RouteParamsCriteria::class);
        $this->criteria()->push(RulesCriteria::class);
        $this->criteria()->push(ColumnsCriteria::class);
        $this->criteria()->push(WithCriteria::class);
        $this->criteria()->push(OrdersCriteria::class);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        $this->prepare();

        try {
            $this->triggerOnExecute();
            $result = $this->execute();
            $this->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            $this->triggerOnExecuteError($e);
            throw $e;
        }

        $this->triggerOnSuccess($result);

        return $result;
    }

    public function prepare()
    {
        $this->triggerOnPrepare();
        try {
            $this->runCriteria();
        } catch (\Exception $e) {
            $this->triggerOnPrepareError($e);
            throw $e;
        }
        $this->triggerOnPrepareEnd();
    }

    public function execute()
    {
        return $this->total()
            ? $this->model()->paginate($this->limit())
            : $this->model()->paginate($this->limit());
    }

}