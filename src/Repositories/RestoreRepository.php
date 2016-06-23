<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\RestoreRepositoryInterface;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Keys;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnSuccess;

class RestoreRepository extends BaseRepository implements RestoreRepositoryInterface
{

    use Data, Keys, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {

    }

}