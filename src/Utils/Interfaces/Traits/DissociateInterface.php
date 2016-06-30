<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface DissociateInterface
{

    /**
     * @param null|array|Closure|Collection $dissociate
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