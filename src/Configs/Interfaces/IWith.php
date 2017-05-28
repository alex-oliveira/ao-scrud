<?php

namespace AoScrud\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IWith
{

    /**
     * @param null|array|Collection|Closure $with
     * @return $this|Collection
     */
    public function with($with = null);

    /**
     * @param array|Collection|Closure $with
     * @return $this
     */
    public function setWith($with);

    /**
     * @return Collection
     */
    public function getWith();

}