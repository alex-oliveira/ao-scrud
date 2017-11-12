<?php

namespace AoScrud\Services\Configs;

use Closure;
use Illuminate\Support\Collection;

trait With
{

    /**
     * @var null|Collection|Closure
     */
    protected $with = null;

    /**
     * @param null|array|Collection|Closure $with
     * @return $this|Collection
     */
    public function with($with = null)
    {
        if (is_null($with))
            return $this->getWith();
        return $this->setWith($with);
    }

    /**
     * @param array|Collection|Closure $with
     * @return $this
     */
    public function setWith($with)
    {
        if (is_array($with))
            $this->with = collect($with);

        elseif ($with instanceof Collection || $with instanceof Closure)
            $this->with = $with;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWith()
    {
        if ($this->with instanceof Collection)
            return $this->with;

        if ($this->with instanceof Closure) {
            $closure = $this->with;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->with = collect([]);
    }

}