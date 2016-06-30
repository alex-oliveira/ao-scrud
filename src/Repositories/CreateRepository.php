<?php

namespace AoScrud\Repositories;

use AoScrud\Interfaces\Repositories\CreateRepositoryInterface;
use AoScrud\Utils\Traits\Columns;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Rules;

class CreateRepository extends BaseRepository implements CreateRepositoryInterface
{

    use Data, Columns, Rules, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

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
        Validate()->actor($this)->data($this->data())->rules($this->rules())->run();
    }

    public function filter()
    {
        $this->data = $this->data->only($this->columns()->all());
    }

    public function execute()
    {
        return $this->model()->create($this->data()->all());
    }

}