<?php

namespace AoScrud\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface ICascade
{

    /**
     * @param null|array|Closure|Collection $cascade
     * @return $this|Collection
     */
    public function cascade($cascade = null);

    /**
     * @param array|Closure|Collection $cascade
     * @return $this
     */
    public function setCascade($cascade);

    /**
     * @return Collection
     */
    public function getCascade();

}