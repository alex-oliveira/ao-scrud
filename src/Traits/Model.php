<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Database\Eloquent\Model as LaraModel;

trait Model
{

    /**
     * @var null|LaraModel|Closure
     */
    protected $model = null;

    /**
     * @param null|string|LaraModel|Closure $model
     * @return $this|LaraModel
     */
    public function model($model = null)
    {
        if (is_null($model))
            return $this->getModel();
        return $this->setModel($model);
    }

    /**
     * @param string|LaraModel|Closure $model
     * @return $this
     */
    public function setModel($model)
    {
        if (is_string($model))
            $this->model = app()->make($model);

        elseif ($model instanceof LaraModel || $model instanceof Closure)
            $this->model = $model;

        return $this;
    }

    /**
     * @return null|LaraModel
     */
    public function getModel()
    {
        if ($this->model instanceof Closure) {
            $closure = $this->model;
            $result = $closure($this);
            return is_string($result) ? $result = app()->make($result) : $result;
        }

        return $this->model;
    }

}