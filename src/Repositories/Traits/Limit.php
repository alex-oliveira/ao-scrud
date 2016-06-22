<?php

namespace AoScrud\Repositories\Traits;

trait Limit
{

    /**
     * @var int
     */
    protected $limit = 50;

    /**
     * @param int|null $limit
     * @return $this|int
     */
    public function limit($limit = null)
    {
        if (is_null($limit))
            return $this->getLimit();
        return $this->setLimit($limit);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

}