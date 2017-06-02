<?php

namespace AoScrud\Configs\Interfaces;

use Closure;

interface ILimit
{

    /**
     * @param null|int|Closure $limit
     * @return $this|int
     */
    public function limit($limit = null);

    /**
     * @param int|Closure $limit
     * @return $this
     */
    public function setLimit($limit);

    /**
     * @return int
     */
    public function getLimit();

}