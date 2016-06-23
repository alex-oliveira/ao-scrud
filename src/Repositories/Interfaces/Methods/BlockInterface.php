<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface BlockInterface
{

    /**
     * @param array|null $block
     * @return $this|Collection
     */
    public function block(array $block = null);

    /**
     * @return Collection
     */
    public function getBlock();

    /**
     * @param array $block
     * @return $this
     */
    public function setBlock(array $block);

}