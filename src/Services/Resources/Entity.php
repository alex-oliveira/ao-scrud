<?php

namespace AoScrud\Services\Resources;

use Illuminate\Database\Eloquent\Model;

trait Entity
{

    /**
     * The name model.
     *
     * @var Model
     */
    protected $modelName;

    /**
     * The model.
     *
     * @var Model
     */
    private $model;

    /**
     * Return the model.
     *
     * @return Model
     */
    public function model()
    {
        return is_null($this->model) ? $this->model = app()->make($this->modelName) : $this->model;
    }

}