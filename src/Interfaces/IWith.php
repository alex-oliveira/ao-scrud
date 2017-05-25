<?php

namespace AoScrud\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IWith
{

    /**
     * @param null|array|Closure|Collection $with
     * @return $this|Collection
     */
    public function with($with = null);

    /**
     * @param array|Closure|Collection $with
     * @return $this
     */
    public function setWith($with);

    /**
     * @return Collection
     */
    public function getWith();

}