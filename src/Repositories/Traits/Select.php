<?php

namespace AoScrud\Repositories\Traits;

use AoScrud\Repositories\Interfaces\Methods\KeysInterface;

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
            $closure = $this->getSelectDefault();
        else
            $closure = $this->select;

        return $closure($this);
    }

    /**
     * @return \Closure
     */
    public function getSelectDefault()
    {
        return function ($rep) {
            $keys = $rep instanceof KeysInterface ? $rep->keys() : [];

            if (empty($keys))
                return $rep->model()->find($rep->data()->get('id'));

            $model = $rep->model();
            foreach ($rep->keys() as $key)
                $model = $model->where($key, $rep->data()->get($key));

            return $model->first();
        };
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