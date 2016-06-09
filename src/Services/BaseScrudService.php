<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Entity;
use Illuminate\Database\Eloquent\Model;

abstract class BaseScrudService
{

    /**
     * The model name.
     *
     * @var string
     */
    protected $model;

    /**
     * Return the model.
     *
     * @return Model
     */
    protected function model()
    {
        return app()->make($this->model);
    }

}