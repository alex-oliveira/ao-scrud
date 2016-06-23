<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\DestroyRepositoryInterface;
use AoScrud\Repositories\Traits\Block;
use AoScrud\Repositories\Traits\Cascade;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Dissociate;
use AoScrud\Repositories\Traits\Keys;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\Soft;

class DestroyRepository extends BaseRepository implements DestroyRepositoryInterface
{

    use Data, Keys, Block, Cascade, Dissociate, Soft, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {

    }

}