<?php

namespace AoScrud\Services\Configs;

use Closure;
use Illuminate\Support\Collection;

trait Dissociate
{

    /**
     * @var null|Collection|Closure
     */
    protected $dissociate = null;

    /**
     * @param null|array|Collection|Closure $dissociate
     * @return $this|Collection
     */
    public function dissociate($dissociate = null)
    {
        if (is_null($dissociate))
            return $this->getDissociate();
        return $this->setDissociate($dissociate);
    }

    /**
     * @param array|Closure|Collection $dissociate
     * @return $this
     */
    public function setDissociate($dissociate)
    {
        if (is_array($dissociate))
            $this->dissociate = collect($dissociate);

        elseif ($dissociate instanceof Collection || $dissociate instanceof Closure)
            $this->dissociate = $dissociate;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getDissociate()
    {
        if ($this->dissociate instanceof Collection)
            return $this->dissociate;

        if ($this->dissociate instanceof Closure) {
            $closure = $this->dissociate;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->dissociate = collect([]);
    }

}