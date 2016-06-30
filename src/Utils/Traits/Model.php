<?php

namespace AoScrud\Utils\Traits;

trait Model
{

    /**
     * @var null|\Illuminate\Database\Eloquent\Model
     */
    protected $model = null;

    /**
     * @param null|string $model
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function model($model = null)
    {
        if (is_null($model))
            return $this->getModel();

        if (is_string($model))
            $model = app()->make($model);

        return $this->setModel($model);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

}