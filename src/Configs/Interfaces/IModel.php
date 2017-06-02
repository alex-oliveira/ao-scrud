<?php

namespace AoScrud\Configs\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface IModel
{

    /**
     * @param null|string|Model|Closure $model
     * @return $this|Model
     */
    public function model($model = null);

    /**
     * @param string|Model|Closure $model
     * @return $this
     */
    public function setModel($model);

    /**
     * @return null|Model
     */
    public function getModel();

}