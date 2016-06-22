<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\RestoreRepositoryInterface;
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
use AoScrud\Repositories\Traits\Select;

class RestoreRepository extends BaseRepository implements RestoreRepositoryInterface
{

    use Select, Obj, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        // TODO: Implement run() method.
    }

}