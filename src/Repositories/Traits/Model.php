<?php

namespace AoScrud\Repositories\Traits;

trait Model
{

    /**
     * @var string
     */
    protected $model = null;

    /**
     * @param string|null $model
     * @return $this|string
     */
    public function model($model = null)
    {
        if (is_null($model))
            return $this->getModel();
        return $this->setModel($model);
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

}