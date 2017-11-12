<?php

namespace AoScrud\Services\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IDissociate
{

    /**
     * @param null|array|Collection|Closure $dissociate
     * @return $this|Collection
     */
    public function dissociate($dissociate = null);

    /**
     * @param array|Closure|Collection $dissociate
     * @return $this
     */
    public function setDissociate($dissociate);

    /**
     * @return Collection
     */
    public function getDissociate();

}