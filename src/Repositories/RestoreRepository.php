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

    public function __construct()
    {
        $this->model($this->model()->onlyTrashed());

//        $this->select(function(){
//            return function ($rep) {
//                $keys = $rep instanceof KeysInterface ? $rep->keys() : [];
//
//                if (empty($keys))
//                    return $rep->model()->find($rep->data()->get('id'));
//
//                $model = $rep->model();
//                foreach ($rep->keys() as $key)
//                    $model = $model->where($key, $rep->data()->get($key));
//
//                return $model->first();
//            };
//        });
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
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
        dd($this->obj());
        return $this->obj()->restore();
    }

}