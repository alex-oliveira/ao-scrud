<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Traits\Model;

abstract class ScrudRepository
{

    use Model;

    abstract public function run(array $data);

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function makeModel()
    {
        return app()->make($this->model());
    }

}