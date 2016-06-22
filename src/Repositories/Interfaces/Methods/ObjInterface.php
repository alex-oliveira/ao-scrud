<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface ObjInterface
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|mixed $obj
     * @return $this|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function obj($obj = null);

    /**
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function getObj();

    /**
     * @param \Illuminate\Database\Eloquent\Model|mixed $obj
     * @return $this
     */
    public function setObj($obj);

}