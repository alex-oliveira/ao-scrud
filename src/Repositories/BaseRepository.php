<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Traits\Model;

abstract class BaseRepository
{

    use Model;

    /**
     * @return mixed
     * @throws \Exception
     */
    abstract public function run();

}