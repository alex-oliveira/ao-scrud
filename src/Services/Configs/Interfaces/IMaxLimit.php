<?php

namespace AoScrud\Services\Configs\Interfaces;

use Closure;

interface IMaxLimit
{

    /**
     * @param null|int|Closure $maxLimit
     * @return $this|int
     */
    public function maxLimit($maxLimit = null);

    /**
     * @param int|Closure $maxLimit
     * @return $this
     */
    public function setMaxLimit($maxLimit);

    /**
     * @return int
     */
    public function getMaxLimit();

}