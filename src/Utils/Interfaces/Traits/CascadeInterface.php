<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface CascadeInterface
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