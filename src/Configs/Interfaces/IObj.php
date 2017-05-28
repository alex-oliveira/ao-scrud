<?php

namespace AoScrud\Configs\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface IObj
{

    /**
     * @param Model|mixed $obj
     * @return $this|Model|mixed
     */
    public function obj($obj = null);

    /**
     * @return Model|mixed
     */
    public function getObj();

    /**
     * @param Model|mixed $obj
     * @return $this
     */
    public function setObj($obj);

}