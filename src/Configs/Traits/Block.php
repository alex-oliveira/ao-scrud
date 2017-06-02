<?php

namespace AoScrud\Configs\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Block
{

    /**
     * @var null|Collection|Closure
     */
    protected $block = null;

    /**
     * @param null|array|Collection|Closure $block
     * @return $this|Collection
     */
    public function block($block = null)
    {
        if (is_null($block))
            return $this->getBlock();
        return $this->setBlock($block);
    }

    /**
     * @param array|Collection|Closure $block
     * @return $this
     */
    public function setBlock($block)
    {
        if (is_array($block))
            $this->block = collect($block);

        elseif ($block instanceof Collection || $block instanceof Closure)
            $this->block = $block;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBlock()
    {
        if ($this->block instanceof Collection)
            return $this->block;

        if ($this->block instanceof Closure) {
            $closure = $this->block;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->block = collect([]);
    }

}