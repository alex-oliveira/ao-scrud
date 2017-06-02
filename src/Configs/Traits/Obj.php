<?php

namespace AoScrud\Configs\Traits;

use Illuminate\Database\Eloquent\Model as LaraModel;

trait Obj
{

    /**
     * @var LaraModel|mixed
     */
    protected $obj = null;

    /**
     * @param LaraModel|mixed $obj
     * @return $this|LaraModel|mixed
     */
    public function obj($obj = null)
    {
        if (is_null($obj))
            return $this->getObj();
        return $this->setObj($obj);
    }

    /**
     * @return LaraModel|mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * @param LaraModel|mixed $obj
     * @return $this
     */
    public function setObj($obj)
    {
        $this->obj = $obj;
        return $this;
    }

}