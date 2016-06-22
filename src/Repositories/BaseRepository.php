<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Traits\Model;

abstract class BaseRepository
{

    use Model;

    /**
     * @param array $config
     * @return mixed
     */
    abstract public function run(array $config = []);

}