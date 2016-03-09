<?php

namespace AoScrud\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class ScrudRepository extends BaseRepository
{

    /**
     * Return the current model.
     *
     * @return Model
     */
    public function modelCurrent()
    {
        return $this->model;
    }

}