<?php

namespace AoScrud\Utils\Traits;

trait Limit
{

    /**
     * @var int
     */
    protected $limit = 40;

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
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        $limit = $this->data()->get('limit', false);
        $limit = $limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->limit()
            ? $limit
            : 20;

        return $limit;
    }

}