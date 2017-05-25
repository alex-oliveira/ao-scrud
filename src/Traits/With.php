<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait With
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $with = null;

    /**
     * @param null|array|Closure|Collection $with
     * @return $this|Collection
     */
    public function with($with = null)
    {
        if (is_null($with))
            return $this->getWith();
        return $this->setWith($with);
    }

    /**
     * @param array|Closure|Collection $with
     * @return $this
     */
    public function setWith($with)
    {
        $this->with = is_array($with) ? collect($with) : $with;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getWith()
    {
        if ($this->with instanceof Collection)
            return $this->with;

        if (is_null($this->with))
            return $this->with = collect([]);

        if (is_array($this->with))
            return $this->with = collect($this->with);

        if ($this->with instanceof Closure) {
            $closure = $this->with;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->with = collect([]);
    }

}