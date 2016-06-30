<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface BlockInterface
{

    /**
     * @param null|array|Closure|Collection $block
     * @return $this|Collection
     */
    public function block($block = null);

    /**
     * @param array|Closure|Collection $block
     * @return $this
     */
    public function setBlock($block);

    /**
     * @return Collection
     */
    public function getBlock();

}