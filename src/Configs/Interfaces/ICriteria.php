<?php

namespace AoScrud\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface ICriteria
{

    /**
     * @param null|array|Collection|Closure $criteria
     * @return $this|Collection
     */
    public function criteria($criteria = null);

    /**
     * @param array|Collection|Closure $criteria
     * @return $this
     */
    public function setCriteria($criteria);

    /**
     * @return Collection
     */
    public function getCriteria();

    //------------------------------------------------------------------------------------------------------------------

    public function runCriteria();

}