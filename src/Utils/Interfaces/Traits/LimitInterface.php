<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface LimitInterface
{

    /**
     * @param int|null $limit
     * @return $this|int
     */
    public function limit($limit = null);

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit);

    /**
     * @return int
     */
    public function getLimit();

}