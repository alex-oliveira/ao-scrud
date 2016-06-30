<?php

namespace AoScrud\Repositories;

use AoScrud\Interfaces\Repositories\SearchRepositoryInterface;
use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\OrdersCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\RulesCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Utils\Traits\Columns;
use AoScrud\Utils\Traits\Criteria;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Keys;
use AoScrud\Utils\Traits\Limit;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Orders;
use AoScrud\Utils\Traits\OtherColumns;
use AoScrud\Utils\Traits\Rules;
use AoScrud\Utils\Traits\Total;
use AoScrud\Utils\Traits\With;

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