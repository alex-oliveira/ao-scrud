<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Cascade
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $cascade = null;

    /**
     * @param null|array|Closure|Collection $cascade
     * @return $this|Collection
     */
    public function cascade($cascade = null)
    {
        if (is_null($cascade))
            return $this->getCascade();
        return $this->setCascade($cascade);
    }

    /**
     * @param array|Closure|Collection $cascade
     * @return $this
     */
    public function setCascade($cascade)
    {
        $this->cascade = is_array($cascade) ? collect($cascade) : $cascade;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCascade()
    {
        if ($this->cascade instanceof Collection)
            return $this->cascade;

        if (is_null($this->cascade))
            return $this->cascade = collect([]);

        if (is_array($this->cascade))
            return $this->cascade = collect($this->cascade);

        if ($this->cascade instanceof Closure) {
            $closure = $this->cascade;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->cascade = collect([]);
    }

}