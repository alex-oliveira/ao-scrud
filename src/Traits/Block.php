<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Block
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $block = null;

    /**
     * @param null|array|Closure|Collection $block
     * @return $this|Collection
     */
    public function block($block = null)
    {
        if (is_null($block))
            return $this->getBlock();
        return $this->setBlock($block);
    }

    /**
     * @param array|Closure|Collection $block
     * @return $this
     */
    public function setBlock($block)
    {
        $this->block = is_array($block) ? collect($block) : $block;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getBlock()
    {
        if ($this->block instanceof Collection)
            return $this->block;

        if (is_null($this->block))
            return $this->block = collect([]);

        if (is_array($this->block))
            return $this->block = collect($this->block);

        if ($this->block instanceof Closure) {
            $closure = $this->block;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->block = collect([]);
    }

}