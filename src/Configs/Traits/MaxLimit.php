<?php

namespace AoScrud\Configs\Traits;

use Closure;

trait MaxLimit
{

    /**
     * @var int|Closure
     */
    protected $maxLimit = 50;

    /**
     * @param null|int|Closure $maxLimit
     * @return $this|int
     */
    public function maxLimit($maxLimit = null)
    {
        if (is_null($maxLimit))
            return $this->getMaxLimit();
        return $this->setMaxLimit($maxLimit);
    }

    /**
     * @param int|Closure $maxLimit
     * @return $this
     */
    public function setMaxLimit($maxLimit)
    {
        if (is_numeric($maxLimit) && is_int($maxLimit + 0) && $maxLimit > 0)
            $this->maxLimit = $maxLimit;

        elseif ($maxLimit instanceof Closure)
            $this->maxLimit = $maxLimit;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLimit()
    {
        return $this->maxLimit;
    }

}