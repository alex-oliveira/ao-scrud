<?php

namespace AoScrud\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface ICascade
{

    /**
     * @param null|array|Collection|Closure $cascade
     * @return $this|Collection
     */
    public function cascade($cascade = null);

    /**
     * @param array|Collection|Closure $cascade
     * @return $this
     */
    public function setCascade($cascade);

    /**
     * @return Collection
     */
    public function getCascade();

}