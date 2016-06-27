<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Block
{

    /**
     * @var null|Collection
     */
    protected $block = null;

    /**
     * @param array|null $block
     * @return $this|Collection
     */
    public function block(array $block = null)
    {
        if (is_null($block))
            return $this->getBlock();
        return $this->setBlock($block);
    }

    /**
     * @return Collection
     */
    public function getBlock()
    {
        return is_null($this->block) ? $this->block = collect([]) : $this->block;
    }

    /**
     * @param array $block
     * @return $this
     */
    public function setBlock(array $block)
    {
        $this->block = collect($block);
        return $this;
    }

}