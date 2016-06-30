<?php

namespace AoScrud\Utils\Traits;

trait Obj
{

    /**
     * @var \Illuminate\Database\Eloquent\Model|mixed
     */
    protected $obj = null;

    /**
     * @param \Illuminate\Database\Eloquent\Model|mixed $obj
     * @return $this|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function obj($obj = null)
    {
        if (is_null($obj))
            return $this->getObj();
        return $this->setObj($obj);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|mixed $obj
     * @return $this
     */
    public function setObj($obj)
    {
        $this->obj = $obj;
        return $this;
    }

}