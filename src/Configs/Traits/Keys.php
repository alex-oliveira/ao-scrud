<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Keys
{

    /**
     * @var null|Collection|Closure
     */
    protected $keys = null;

    /**
     * @param null|array|Collection|Closure $keys
     * @return $this|Collection
     */
    public function keys($keys = null)
    {
        if (is_null($keys))
            return $this->getKeys();
        return $this->setKeys($keys);
    }

    /**
     * @param array|Collection|Closure $keys
     * @return $this
     */
    public function setKeys($keys)
    {
        if (is_array($keys))
            $this->keys = collect($keys);

        elseif ($keys instanceof Collection || $keys instanceof Closure)
            $this->keys = $keys;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getKeys()
    {
        if ($this->keys instanceof Collection)
            return $this->keys;

        if ($this->keys instanceof Closure) {
            $closure = $this->keys;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->keys = collect([]);
    }

}