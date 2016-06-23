<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Criteria\ColumnsCriteria;
use AoScrud\Repositories\Criteria\RouteParamsCriteria;
use AoScrud\Repositories\Interfaces\Repositories\ReadRepositoryInterface;
use AoScrud\Repositories\Traits\Columns;
use AoScrud\Repositories\Traits\Criteria;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Keys;
use AoScrud\Repositories\Traits\Obj;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnPrepare;
use AoScrud\Repositories\Traits\OnPrepareEnd;
use AoScrud\Repositories\Traits\OnPrepareError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\OtherColumns;
use AoScrud\Repositories\Traits\Select;
use AoScrud\Repositories\Traits\With;

class ReadRepository extends BaseRepository implements ReadRepositoryInterface
{

    use Keys, Data, Columns, OtherColumns, Criteria, With, Select, Obj, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    public function __construct()
    {
        $this->criteria()->push(RouteParamsCriteria::class);
        $this->criteria()->push(ColumnsCriteria::class);
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
        $this->obj($this->select());
        return $this->obj();
    }

}