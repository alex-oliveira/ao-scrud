<?php

namespace AoScrud\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IKeys
{

    /**
     * @param null|array|Collection|Closure $keys
     * @return $this|Collection
     */
    public function keys($keys = null);

    /**
     * @param array|Collection|Closure $keys
     * @return $this
     */
    public function setKeys($keys);

    /**
     * @return Collection
     */
    public function getKeys();

}