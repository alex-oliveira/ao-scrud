<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface LimitInterface
{

    /**
     * @param int|null $limit
     * @return $this|int
     */
    public function limit($limit = null);

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit);

}