<?php

namespace AoScrud\Configs\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Data
{

    /**
     * @var null|Collection|Closure
     */
    protected $data = null;

    /**
     * @param null|array|Collection|Closure $data
     * @return $this|Collection
     */
    public function data($data = null)
    {
        if (is_null($data))
            return $this->getData();
        return $this->setData($data);
    }

    /**
     * @param array|Collection|Closure $data
     * @return $this
     */
    public function setData($data)
    {
        if (is_array($data))
            $this->data = collect($data);

        elseif ($data instanceof Collection || $data instanceof Closure)
            $this->data = $data;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getData()
    {
        if ($this->data instanceof Collection)
            return $this->data;

        if ($this->data instanceof Closure) {
            $closure = $this->data;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->data = collect([]);
    }

}