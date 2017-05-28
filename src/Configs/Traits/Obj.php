<?php

namespace AoScrud\Traits;

use Illuminate\Database\Eloquent\Model;

trait Obj
{

    /**
     * @var Model|mixed
     */
    protected $obj = null;

    /**
     * @param Model|mixed $obj
     * @return $this|Model|mixed
     */
    public function obj($obj = null)
    {
        if (is_null($obj))
            return $this->getObj();
        return $this->setObj($obj);
    }

    /**
     * @return Model|mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * @param Model|mixed $obj
     * @return $this
     */
    public function setObj($obj)
    {
        $this->obj = $obj;
        return $this;
    }

}