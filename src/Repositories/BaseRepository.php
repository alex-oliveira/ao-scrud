<?php

namespace AoScrud\Repositories;

use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Traits\Model;

abstract class BaseRepository implements ModelInterface
{

    use Model;

    /**
     * @return mixed
     * @throws \Exception
     */
    abstract public function run();

}