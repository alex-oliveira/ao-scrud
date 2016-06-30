<?php

namespace AoScrud\Utils\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Dissociate
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $dissociate = null;

    /**
     * @param null|array|Closure|Collection $dissociate
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
        $this->dissociate = is_array($dissociate) ? collect($dissociate) : $dissociate;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getDissociate()
    {
        if ($this->dissociate instanceof Collection)
            return $this->dissociate;

        if (is_null($this->dissociate))
            return $this->dissociate = collect([]);

        if (is_array($this->dissociate))
            return $this->dissociate = collect($this->dissociate);

        if ($this->dissociate instanceof Closure) {
            $closure = $this->dissociate;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->dissociate = collect([]);
    }

}