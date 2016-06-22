<?php

namespace AoScrud\Repositories\Traits;

trait Select
{

    /**
     * @var null|\Closure
     */
    protected $select = null;

    /**
     * @param \Closure|null $select
     * @return $this|\Closure
     */
    public function select(\Closure $select = null)
    {
        if (is_null($select))
            return $this->getSelect();
        return $this->setSelect($select);
    }

    /**
     * @return \Closure
     */
    public function getSelect()
    {
        if (is_null($this->select))
            return null;

        $closure = $this->select;
        return $closure($this);
    }

    /**
     * @param \Closure $select
     * @return $this
     */
    public function setSelect(\Closure $select)
    {
        $this->select = $select;
        return $this;
    }

}