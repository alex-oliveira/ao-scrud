<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface OtherColumnsInterface
{

    /**
     * @param null|array|Closure|Collection $columns
     * @return $this|Collection
     */
    public function otherColumns($columns = null);

    /**
     * @param array|Closure|Collection $columns
     * @return $this
     */
    public function setOtherColumns($columns);

    /**
     * @return Collection
     */
    public function getOtherColumns();

}