<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Cascade
{

    /**
     * @var null|Collection|Closure
     */
    protected $cascade = null;

    /**
     * @param null|array|Collection|Closure $cascade
     * @return $this|Collection
     */
    public function cascade($cascade = null)
    {
        if (is_null($cascade))
            return $this->getCascade();
        return $this->setCascade($cascade);
    }

    /**
     * @param array|Collection|Closure $cascade
     * @return $this
     */
    public function setCascade($cascade)
    {
        if (is_array($cascade))
            $this->cascade = collect($cascade);

        elseif ($cascade instanceof Collection || $cascade instanceof Closure)
            $this->cascade = $cascade;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCascade()
    {
        if ($this->cascade instanceof Collection)
            return $this->cascade;

        if ($this->cascade instanceof Closure) {
            $closure = $this->cascade;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->cascade = collect([]);
    }

}