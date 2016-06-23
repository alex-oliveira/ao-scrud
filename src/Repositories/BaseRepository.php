<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ModelInterface;
use AoScrud\Repositories\Traits\Model;

abstract class BaseRepository implements ModelInterface
{

    use Model;

    /**
     * @return mixed
     * @throws \Exception
     */
    abstract public function run();

}