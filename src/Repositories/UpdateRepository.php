<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\UpdateRepositoryInterface;
use AoScrud\Repositories\Traits\Columns;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Obj;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnPrepare;
use AoScrud\Repositories\Traits\OnPrepareEnd;
use AoScrud\Repositories\Traits\OnPrepareError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\Rules;
use AoScrud\Repositories\Traits\Select;

class UpdateRepository extends BaseRepository implements UpdateRepositoryInterface
{

    use Select, Obj, Columns, Rules, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    public function __construct()
    {
        $this->select(function ($rep) {
            return $rep->model()->find($rep->data()->get('id'));
        });
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        $this->obj($this->select());

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
            $this->validate();
            $this->filter();
        } catch (\Exception $e) {
            $this->triggerOnPrepareError($e);
            throw $e;
        }
        $this->triggerOnPrepareEnd();
    }

    public function validate()
    {
        Validate()->actor($this)->data($this->data())->rules($this->rules())->obj($this->obj())->run();
    }

    public function filter()
    {
        $this->data = $this->data->only($this->columns()->all());
    }

    public function execute()
    {
        $this->obj()->fill($this->data()->all());
        return $this->obj()->isDirty() ? $this->obj()->save() : false;
    }

}