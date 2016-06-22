<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\CreateRepositoryInterface;
use AoScrud\Repositories\Traits\Columns;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnPrepare;
use AoScrud\Repositories\Traits\OnPrepareEnd;
use AoScrud\Repositories\Traits\OnPrepareError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\Rules;

class CreateRepository extends BaseRepository implements CreateRepositoryInterface
{

    use Columns, Rules, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    /**
     * @param array $config
     * @return mixed
     * @throws \Exception
     */
    public function run(array $config = [])
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