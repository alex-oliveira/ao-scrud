<?php

namespace AoScrud\Services\Configs;

use AoScrud\Services\Configs\Interfaces\IKeys;
use Closure;

trait Select
{

    /**
     * @var null|Closure
     */
    protected $select = null;

    /**
     * @param null|Closure $select
     * @return $this|Closure
     */
    public function select(Closure $select = null)
    {
        if (is_null($select))
            return $this->getSelect();
        return $this->setSelect($select);
    }

    /**
     * @param Closure $select
     * @return $this
     */
    public function setSelect(Closure $select)
    {
        $this->select = $select;
        return $this;
    }

    /**
     * @return Closure
     */
    public function getSelect()
    {
        $closure = is_null($this->select) ? $this->getSelectDefault() : $this->select;
        return $closure($this);
    }

    /**
     * @return Closure
     */
    public function getSelectDefault()
    {
        return function ($config) {
            $keys = $config instanceof IKeys ? $config->keys() : [];

            if (empty($keys))
                return $config->model()->find($config->data()->get('id'));

            $model = $config->model();
            foreach ($keys as $key)
                $model = $model->where($key, $config->data()->get($key));

            return $model->first();
        };
    }

}
