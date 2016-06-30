<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface ModelInterface
{

    /**
     * @param null|string $model
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function model($model = null);

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     */
    public function setModel($model);

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

}