<?php

namespace AoScrud\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IBlock
{

    /**
     * @param null|array|Collection|Closure $block
     * @return $this|Collection
     */
    public function block($block = null);

    /**
     * @param array|Collection|Closure $block
     * @return $this
     */
    public function setBlock($block);

    /**
     * @return Collection
     */
    public function getBlock();

}