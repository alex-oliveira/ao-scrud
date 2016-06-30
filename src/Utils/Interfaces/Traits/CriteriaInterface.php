<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface CriteriaInterface
{

    /**
     * @param null|array|Closure|Collection $criteria
     * @return $this|Collection
     */
    public function criteria($criteria = null);

    /**
     * @param array|Closure|Collection $criteria
     * @return $this
     */
    public function setCriteria($criteria);

    /**
     * @return Collection
     */
    public function getCriteria();

    public function runCriteria();

}