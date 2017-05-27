<?php

namespace AoScrud\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IOtherColumns
{

    /**
     * @param null|array|Collection|Closure $columns
     * @return $this|Collection
     */
    public function otherColumns($columns = null);

    /**
     * @param array|Collection|Closure $columns
     * @return $this
     */
    public function setOtherColumns($columns);

    /**
     * @return Collection
     */
    public function getOtherColumns();

}