<?php

namespace AoScrud\Services\Resources;

use Illuminate\Database\Eloquent\Model;

trait Entity
{

    /**
     * The model.
     *
     * @var Model
     */
    private $model;

    /**
     * The name model.
     *
     * @var Model
     */
    protected $modelName;

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