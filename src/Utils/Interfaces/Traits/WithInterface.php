<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface WithInterface
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