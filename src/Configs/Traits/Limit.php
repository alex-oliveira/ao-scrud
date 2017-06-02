<?php

namespace AoScrud\Configs\Traits;

use AoScrud\Configs\Interfaces\IMaxLimit;
use Closure;

trait Limit
{

    /**
     * @var int|Closure
     */
    protected $limit = 20;

    /**
     * @param null|int|Closure $limit
     * @return $this|int
     */
    public function limit($limit = null)
    {
        if (is_null($limit))
            return $this->getLimit();
        return $this->setLimit($limit);
    }

    /**
     * @param int|Closure $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        if (is_numeric($limit) && is_int($limit + 0) && $limit > 0)
            $this->limit = $limit;

        elseif ($limit instanceof Closure)
            $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        $limit = $this->data()->get('limit', false);
        $limit = $limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0
            ? $limit
            : 20;

        if ($this instanceof IMaxLimit && $limit > $this->getMaxLimit())
            $limit = $this->getMaxLimit();

        return $limit;
    }

}