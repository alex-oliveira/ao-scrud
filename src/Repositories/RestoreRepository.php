<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\RestoreRepositoryInterface;
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
use AoScrud\Repositories\Traits\Select;

class RestoreRepository extends BaseRepository implements RestoreRepositoryInterface
{

    use Data, Keys, Select, Obj, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        $this->model($this->model()->onlyTrashed());

        $this->prepare();

        $t = Transaction()->begin();
        try {
            $this->triggerOnExecute();
            $result = $this->execute();
            $this->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            $this->triggerOnExecuteError($e);
            throw $e;
        }
        Transaction()->commit($t);

        $this->triggerOnSuccess($result);

        return $result;
    }

    public function prepare()
    {
        $this->triggerOnPrepare();
        try {
            $this->read();
        } catch (\Exception $e) {
            $this->triggerOnPrepareError($e);
            throw $e;
        }
        $this->triggerOnPrepareEnd();
    }

    public function read()
    {
        $obj = $this->select();
        $obj ? $this->obj($obj) : abort(404);
    }

    public function execute()
    {
        return $this->obj()->restore();
    }

}